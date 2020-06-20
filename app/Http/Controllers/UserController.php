<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Services\NotificationService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private NotificationService $notificationService;

    /**
     * UserController constructor.
     * @param NotificationService $notificationService
     */
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
        $user = auth()->user();

        return view('user.index', ['username' => $user->name, 'id' => $user->id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return RedirectResponse
     * @todo If Admin Page is required
     */
    public function create()
    {
        return redirect()->route('user.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @todo If Admin Page is required
     */
    public function store(Request $request)
    {
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return RedirectResponse
     * @todo If Admin Page is required
     */
    public function show($id)
    {
        return redirect()->route('user.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function edit($id): Renderable
    {
        $user = auth()->user();

        return view('user.edit', ['username' => $user->name, 'email' => $user->email, 'id' => $user->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     * @todo should handle id´s if Admin Page is required
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $actualPassword = $request->get('actualPassword');

        if (!Hash::check($actualPassword, $user->password))
        {
            $this->notificationService->addStatusMessage(__('user.actual_password_not_match'));
            return redirect()->route('user.edit', $user->id);
        }

        $newEmail = $request->get('email');
        $newPassword = $request->get('password');

        $user->email = $newEmail;
        if ($newPassword)
        {
            $user->password = Hash::make($newPassword);
        }

        $user->save();

        $this->notificationService->addStatusMessage(__('user.edit_successful'));
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     * @todo If Admin Page is required
     */
    public function destroy($id)
    {
        return redirect()->route('user.index');
    }
}
