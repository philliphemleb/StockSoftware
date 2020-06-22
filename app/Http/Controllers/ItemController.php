<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ItemStoreRequest;
use App\Http\Requests\ItemUpdateRequest;
use App\Http\Services\NotificationService;
use App\Item;
use App\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class ItemController extends Controller
{
    /**
     * Contains the App\Http\Services\NotificationService;
     *
     * @var NotificationService
     */
    protected NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->middleware('auth');
        $this->notificationService = $notificationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $itemCollectionData = Item::all();

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
        $tagCollection = $this->getTagsOfRequest($request);

        $item->fill($request->all());
        $item->tags()->saveMany($tagCollection);
        $item->save();

        $this->notificationService->addStatusMessage(__('item.update_successful'));

        return redirect()->route('item.show', ['item' => $item->id]);
    }

    /**
     * Get a TagCollection by given Request.
     *
     * @param ItemUpdateRequest $request
     * @return Collection
     */
    private function getTagsOfRequest(ItemUpdateRequest $request): Collection
    {
        $tagArray = explode(',', $request->get('tags'));

        $tagCollection = new Collection();
        foreach ($tagArray as $tagString)
        {
            $tagString = trim($tagString);
            $tag = Tag::firstOrNew(['name' => $tagString]);

            $tagCollection->add($tag);
        }

        return $tagCollection;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
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
