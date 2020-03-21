<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ConsumerRequest;
use App\Services\ConsumerAuth\ConsumerAuthService;

class ConsumerAuthController extends Controller
{
    public $ConsumerAuthService;


    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('guest', ['except' => ['getLogout', 'findUserDetailsByToken','userResetPassword']]);
        $this->middleware('jwt', ['only' => ['findUserDetailsByToken', 'logout','userResetPassword']]);
        $this->ConsumerAuthService = new ConsumerAuthService();
    }

    public function logout()
    {
        $token = JWTAuth::getToken();
        if ($token) {
            JWTAuth::invalidate($token);
            return response()->json(['已登出'], 200);
        } else {
            return response()->json(['已登出'], 200);
        }
    }

    public function register(ConsumerRequest $request)
    {
        $headers = array('Content-Type' => 'application/json; <a href="http://superlevin.ifengyuan.tw/tag/charset/">charset</a>=utf-8');
        $msg = $this->ConsumerAuthService->register($request);
        if($msg == "兩次密碼不一致"){
            return response()->json($msg, 400, $headers, JSON_UNESCAPED_UNICODE);
        }else{
            return response()->json($msg, 200, $headers, JSON_UNESCAPED_UNICODE);
        }

    }
}
