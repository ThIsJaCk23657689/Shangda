<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConsumerRequest;
use App\Services\ConsumerAuth\ConsumerAuthService;
use Auth;

class ConsumerAuthController extends Controller
{
    public $ConsumerAuthService;

    public function __construct(){
        // $this->middleware('auth');
        $this->middleware('guest', ['except' => ['logout', 'resetPassword']]);
        $this->middleware('jwt', ['only' => ['logout','resetPassword']]);
        $this->ConsumerAuthService = new ConsumerAuthService();
    }

    public function register(ConsumerRequest $request){
        $headers = array('Content-Type' => 'application/json; <a href="http://superlevin.ifengyuan.tw/tag/charset/">charset</a>=utf-8');
        $msg = $this->ConsumerAuthService->register($request);
        if($msg == "兩次密碼不一致"){
            return response()->json($msg, 400, $headers, JSON_UNESCAPED_UNICODE);
        }else{
            return response()->json($msg, 200, $headers, JSON_UNESCAPED_UNICODE);
        }
    }

    public function resetPassword(Request $request){
        $headers = array('Content-Type' => 'application/json; <a href="http://superlevin.ifengyuan.tw/tag/charset/">charset</a>=utf-8');
        $msg = $this->ConsumerAuthService->resetPassword($request);
        if($msg == "重設密碼成功"){
            return response()->json($msg, 200, $headers, JSON_UNESCAPED_UNICODE);
        }else{
            return response()->json($msg, 400, $headers, JSON_UNESCAPED_UNICODE);
        }
    }
}
