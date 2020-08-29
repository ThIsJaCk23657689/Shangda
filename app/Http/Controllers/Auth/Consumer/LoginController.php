<?php

namespace App\Http\Controllers\Auth\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest:consumer')->except('logout');
        $this->middleware('guest');
    }

    // 客戶登入頁面
    public function showLoginForm(){
        return view('frontend.consumers.auth.login');
    }

    protected function authenticated(Request $request, $user)
    {
        Log::channel('consumers')->info('編號：' . $user->id . '，姓名：' . $user->name . ' 已成功登入！');
        return [
            'redirect_url' => redirect()->intended($this->redirectPath())->getTargetUrl()
        ];
    }

    public function username()
    {
        return 'account';
    }

    protected function guard()
    {
        return Auth::guard('consumer');
    }

    public function logout(Request $request)
    {
        $user = Auth::guard('consumer')->user();

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->loggedOut($request, $user) ?: redirect('/');
    }

    protected function loggedOut(Request $request, $user)
    {
        Log::channel('consumers')->info('編號：' . $user->id . '，姓名：' . $user->name . ' 已成功登出。');
        return redirect('/');
    }
}