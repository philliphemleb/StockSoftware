<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ItemStoreRequest;
use App\Http\Requests\ItemUpdateRequest;
use App\Http\Services\ItemService;
use App\Http\Services\NotificationService;
use App\Item;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class ItemController extends Controller
{
    /**
     * Contains the App\Http\Services\NotificationService;
     *
     * @var NotificationService
     */
    protected NotificationService $notificationService;

    /**
     * Contains the App\Http\Services\ItemService;
     *
     * @var ItemService
     */
    protected ItemService $itemService;

    public function __construct(NotificationService $notificationService, ItemService $itemService)
    {
        $this->middleware('auth');
        $this->notificationService = $notificationService;
        $this->itemService = $itemService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request): Renderable
    {
        $itemCollectionData = Item::all();

        $searchString = $request->get('search');
        if ($searchString)
        {
            $itemCollectionData = Item::where(function (Builder $query) use ($searchString) {
                return $query->where('name','LIKE',$searchString.'%');
            })->limit(5)->get();
        }

        return view('item.index', ['itemCollection' => $itemCollectionData]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ItemStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ItemStoreRequest $request): RedirectResponse
    {
        $user = auth()->user();

        $item = new Item();
        $item->fill($request->all());
        $item->user_id = $user->id;
        $item->save();

        return redirect()->route('item.show', $item->id);
    }

    /**
     * Redirects to edit page for a specific item.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function show(int $id): RedirectResponse
    {
        return redirect()->route('item.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return RedirectResponse|Renderable
     */
    public function edit($id)
    {
        try {
            $item = Item::findOrFail($id);
        } catch(ModelNotFoundException $e) {
            $this->notificationService->addStatusMessage(__('item.not_found'));
            return redirect()->route('item.index');
        }

        return view('item.edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ItemUpdateRequest $request
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(ItemUpdateRequest $request, $id)
    {
        try {
            $item = Item::findOrFail($id);
        } catch(ModelNotFoundException $e) {
            $this->notificationService->addStatusMessage(__('item.update_unsuccessful'));
            return redirect()->route('item.index');
        }

        $this->itemService->addTagsToItemFromString($item, $request->get('tags'));
        $this->itemService->deleteTagsFromItemWithString($item, $request->get('deleteTags'));
        $this->itemService->addCategoriesToItemFromString($item, $request->get('categories'));
        $this->itemService->deleteCategoriesFromItemWithString($item, $request->get('deleteCategories'));
        $item->fill($request->all());

        $item->save();

        $this->notificationService->addStatusMessage(__('item.update_successful'));
        return redirect()->route('item.edit', ['item' => $item->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        try {
            $item = Item::findOrFail($id);
        } catch(ModelNotFoundException $e) {
            $this->notificationService->addStatusMessage(__('item.delete_unsuccessful'));
            return redirect()->route('item.index');
        }
        $item->delete();

        $this->notificationService->addStatusMessage(__('item.delete_successful'));
        return redirect()->route('item.index');
    }
}
