<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ItemStoreRequest;
use App\Http\Requests\ItemUpdateRequest;
use App\Http\Services\ItemService;
use App\Http\Services\NotificationService;
use App\Item;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

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
     * @return Application|Factory|Builder[]|Collection|View
     */
    public function index(Request $request)
    {
        if (! $request->wantsJson())
        {
            return view('item.index');
        }
        $searchString = $request->get('search');
        $skipAmountForPagination = $request->get('skip') ?? 0;
        $totalItems = Item::all()->count();

        $itemCollectionData = Item::with(['tags', 'categories'])->skip($skipAmountForPagination)->take(50)->get();

        if ($searchString)
        {
            $itemCollectionData = Item::where('name','LIKE','%'.$searchString.'%')
                ->with(['tags', 'categories'])
                ->skip($skipAmountForPagination)
                ->take(50)
                ->get();
            $totalItems = $itemCollectionData->count();
        }

        return ['items' => $itemCollectionData, 'totalItems' => $totalItems];
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

        $this->itemService->addTagsToItemFromString($item, $request->tags);
        $this->itemService->addCategoriesToItemFromString($item, $request->categories);

        return redirect()->route('item.edit', $item->id);
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
    public function edit(int $id)
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
    public function update(ItemUpdateRequest $request, int $id)
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
    public function destroy(int $id): RedirectResponse
    {
        try
        {
            $item = Item::findOrFail($id);
            $item->delete();
        }
        catch(ModelNotFoundException $e)
        {
            $this->notificationService->addStatusMessage(__('item.delete_unsuccessful'));
            return redirect()->route('item.index');
        }
        catch(Exception $e)
        {
            $this->notificationService->addStatusMessage(__('exception.unexpected_exception'));
            return redirect()->route('item.index');
        }

        $this->notificationService->addStatusMessage(__('item.delete_successful'));
        return redirect()->route('item.index');
    }
}
