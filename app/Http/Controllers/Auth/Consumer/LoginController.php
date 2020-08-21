<?php

namespace App\Http\Controllers\Auth\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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
}