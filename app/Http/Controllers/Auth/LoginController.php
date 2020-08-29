<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Log;
use Auth;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:consumer');
    }

    protected function authenticated(Request $request, $user)
    {
        Log::channel('users')->info('編號：' . $user->id . '，姓名：' . $user->name . ' 已成功登入。');
        return [
            'redirect_url' => redirect()->intended($this->redirectPath())->getTargetUrl()
        ];
    }

    public function username()
    {
        return 'account';
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->loggedOut($request, $user) ?: redirect('/');
    }

    protected function loggedOut(Request $request, $user)
    {
        Log::channel('users')->info('編號：' . $user->id . '，姓名：' . $user->name . ' 已成功登出。');
        return redirect('/');
    }
}
