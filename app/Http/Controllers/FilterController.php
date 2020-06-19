<?php

namespace App\Http\Controllers;

use App\Filter;
use App\Http\Requests\FilterStoreRequest;
use App\Http\Requests\FilterUpdateRequest;
use App\Http\Services\NotificationService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    private NotificationService $notificationService;

    /**
     * FilterController constructor.
     * @param NotificationService $notificationService
     */
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
        $this->middleware('auth');
    }

    /**
     * Shows every filter in a list
     *
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request): Renderable
    {
        $filterCollection = Filter::all();

        return view('filter.index', ['filterCollection' => $filterCollection]);
    }

    /**
     * Returns the create form
     *
     * @param Request $request
     * @return Renderable
     */
    public function create(Request $request): Renderable
    {
        return view('filter.create');
    }

    /**
     * Stores the filter
     *
     * @param FilterStoreRequest $request
     * @return RedirectResponse
     */
    public function store(FilterStoreRequest $request): RedirectResponse
    {
        $filter = new Filter();
        $filter->fill($request->all());
        $filter->save();

        return redirect()->route('filter.show', $filter->id);
    }

    /**
     * display the specific filter
     *
     * @param int $id
     * @return Renderable|RedirectResponse
     */
    public function show(int $id)
    {
        try {
            $filter = Filter::findOrFail($id);
        } catch(ModelNotFoundException $e) {
            $this->notificationService->addStatusMessage(__('filter.not_found'));
            return redirect()->route('filter.index');
        }

        return view('filter.show', ['filter' => $filter]);
    }

    /**
     * Shows the form for editing the filter.
     *
     * @param int $id
     * @return Renderable|RedirectResponse
     */
    public function edit(int $id)
    {
        try {
            $filter = Filter::findOrFail($id);
        } catch(ModelNotFoundException $e) {
            $this->notificationService->addStatusMessage(__('filter.not_found'));
            return redirect()->route('filter.index');
        }

        return view('filter.edit', ['filter' => $filter]);
    }

    /**
     * Update the specified filter in storage.
     *
     * @param FilterUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(FilterUpdateRequest $request, int $id): RedirectResponse
    {
        try {
            $filter = Filter::findOrFail($id);
        } catch(ModelNotFoundException $e) {
            $this->notificationService->addStatusMessage(__('filter.update_unsuccessful'));
            return redirect()->route('filter.index');
        }
        $filter->fill($request->all());
        $filter->save();

        $this->notificationService->addStatusMessage(__('filter.update_successful'));

        return redirect()->route('filter.show', ['filter' => $filter->id]);
    }

    /**
     * Remove the specified filter from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            $filter = Filter::findOrFail($id);
        } catch(ModelNotFoundException $e) {
            $this->notificationService->addStatusMessage(__('filter.delete_unsuccessful'));
            return redirect()->route('filter.index');
        }
        $filter->delete();

        $this->notificationService->addStatusMessage(__('filter.delete_successful'));
        return redirect()->route('filter.index');
    }
}
