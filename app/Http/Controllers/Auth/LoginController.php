<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\NotificationService;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * @var NotificationService
     */
    private NotificationService $notificationService;

    /**
     * Create a new controller instance.
     *
     * @param NotificationService $notificationService
     */
    public function __construct(NotificationService $notificationService)
    {
        $this->middleware('guest')->except('logout');

        $this->notificationService = $notificationService;
    }

    public function username()
    {
        return 'name';
    }

    public function validateLogin(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'password' => 'required|string',
        ];

        $customMessages = [
            'name.required' => __('login.username_required'),
            'password.required' => __('login.password_required')
        ];

        $this->validate($request, $rules, $customMessages);
    }

    public function authenticated(Request $request, $user)
    {
        $this->notificationService->addStatusMessage(__('login.successful'), 'info');
    }
}
