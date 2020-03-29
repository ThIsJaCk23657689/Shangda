<?php

namespace App\Http\Controllers\Auth\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct(){
        $this->middleware('guest:api')->except('logout');
    }
    
    public function showLoginForm(){
        return view('consumers.login');
    }

    public function login(Request $request){
        // 驗證資料
        $this->validateLogin($request);

        // 如果嘗試登入太多次會被鎖IP跟該顧客account
        if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        // 登入顧客
        if ($token = $this->attemptLogin($request)) {
            return $this->sendLoginResponse($request, $token);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    // 驗證登入資料
    protected function validateLogin(Request $request){
        $request->validate([
            $this->username() => ['required', 'string', 'min:6', 'max:30'],
            'password' => ['required', 'string', 'min:6', 'max:30']
        ]);
    }

    // 嘗試登入
    protected function attemptLogin(Request $request){
        return $this->guard()->attempt($this->credentials($request));
    }

    // 發送登入回應
    protected function sendLoginResponse(Request $request, $token){
        
        $this->clearLoginAttempts($request);

        $cookie_token = 'Bearer ' . $token;

        return response()->json([
            'status' => 1,
            'msg' => 'Login Successfully',
            'token' => $token
        ])->cookie('authorization', $cookie_token, 200);
    }

    protected function sendFailedLoginResponse(Request $request){
        return response()->json([
            'status' => 0,
            'msg' => 'invalid credentials',
        ], 401);
    }

    public function logout(Request $request){
        $this->guard()->logout();

        return response()->json([
            'status' => 0,
            'msg' => 'Logout Successfully',
        ]);
    }  

    // 回傳帳號欄位
    public function username(){
        return 'account';
    }

    protected function guard(){
        return Auth::guard('api');
    }
}
