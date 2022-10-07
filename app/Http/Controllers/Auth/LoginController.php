<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['username', 'password']);

        if (!Auth::validate($credentials)) {
            $this->sendFailedLoginResponse($request);
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);
        $this->updateLoginInfo($user);

        return redirect()->to('/');
    }

    /**
     * Update the users table after login.
     *
     */

    public function updateLoginInfo($user): void
    {
        User::where('id', $user->id)->update(
            [
                'modified_at' => Carbon::now(),
                'last_ip' => \Illuminate\Support\Facades\Request::ip(),
                'last_login' => Carbon::now(),
            ]
        );
    }
}
