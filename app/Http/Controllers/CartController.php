<?php

namespace App\Http\Controllers;
use App\Services\CartService;
use Illuminate\Http\Request;
use App\Http\Requests\CartRequest;
use JWTAuth;

class CartController extends Controller
{
    public $CartService;
    public function __construct()
    {
        $this->middleware('consumer');
        $this->CartService = new CartService();
    }

    public function index()
    {
        // 透過JWTtoken抓使用者
        $token = JWTAuth::getToken();
        $consumer = JWTAuth::toUser($token);
        $carts = $this->CartService->getOne($consumer->id);
        $lastUpdate = $this->CartService->getlastupdate($consumer->id);
        return view('cart.index', compact('carts', 'lastUpdate'));

    }

    public function clearCartDetails(){
        $token = JWTAuth::getToken();
        $consumer = JWTAuth::toUser($token);
        $this->CartService->clearDetails($consumer->id);
        return response()->json("success", 200);
    }
}
