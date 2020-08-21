<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\CartService;
use App\Services\ProductService;
use App\Http\Requests\CartRequest;
use Auth;

class CartController extends Controller
{
    public $CartService;
    public $ProductService;
    public function __construct()
    {
        $this->middleware('auth:consumer');
        $this->CartService = new CartService();
        $this->ProductService = new ProductService();
    }

    // 新增商品到購物車
    public function addProductToCart(Request $request){
        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
        ]);

        $consumer = Auth::guard('consumer')->user();
        $cart = $consumer->cart;

        $product = $this->ProductService->getOne($request->product_id);
        
        //判斷該購物車是否已經有商品
		$onCart_product = $cart->products()->where('product_id', $request->product_id)->first();
		if (empty($onCart_product)) {
			//代表此購物車上沒有此商品 立即新增
			$cart->products()->attach($product->id, [
                'price' => $product->retailPrice,
                'quantity' => 1,
                'discount' => 1,
                'subTotal' => $product->retailPrice * 1,
            ]);
		}

        return response()->json([
            'message' => '已成功加入購物車！'
        ], 200);
    }

    public function clearCartDetails(){
        $token = JWTAuth::getToken();
        $consumer = JWTAuth::toUser($token);
        $this->CartService->clearDetails($consumer->id);
        return response()->json("success", 200);
    }
}
