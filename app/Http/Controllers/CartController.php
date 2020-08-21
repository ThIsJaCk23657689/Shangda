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
            'amount' => 'required|integer'
        ]);

        $consumer = Auth::guard('consumer')->user();
        $cart = $consumer->cart;

        $product = $this->ProductService->getOne($request->product_id);

        //購物車 單商品"最高"訂購數量數
        $max_qty = 20;
        $max_msg = '';
        
        //判斷該購物車是否已經有商品
		$onCart_product = $cart->products()->where('product_id', $request->product_id)->first();
		if (empty($onCart_product)) {
			//代表此購物車上沒有此商品 立即新增
			$max_qty = ($max_qty > $product->quantity) ? $product->quantity : $max_qty;
			$qty = ($request->amount > $max_qty) ? $max_qty : $request->amount;
			$cart->products()->attach($product->id, [
                'price' => $product->retailPrice,
                'quantity' => $request->amount,
                'discount' => 1,
                'subTotal' => $product->retailPrice * $request->amount,
            ]);
		}else{
			//取得該商品舊數量
			$old_qty = $onCart_product->pivot->quantity;
			//新數量 = 新預定數量 + 舊數量
			$new_qty = $request->amount + $old_qty;
			$surplus_qty = $product->quantity;
			if ($surplus_qty < $max_qty) {
				if ($new_qty > $surplus_qty) {
					$new_qty = $surplus_qty;
					$max_msg = '(訂購數量已超出該商品剩餘數量，最多只能訂購' . $surplus_qty . '個)';
				}
			}else if ($surplus_qty >= $max_qty) {
				if ($new_qty > $max_qty) {
					$new_qty = $max_qty;
					$max_msg = '(已超出單商品訂購最大數量，最多只能訂購' . $max_qty . '個)';
				}
			}
			// 覆寫 更新數量
			$cart->products()->updateExistingPivot($product->id, [
                'quantity' => $new_qty,
                'subTotal' => $product->retailPrice * $new_qty,
            ]);
		}

        return response()->json([
            'message' => '已成功加入購物車！' . $max_msg
        ], 200);
    }

    public function clearCartDetails(){
        $token = JWTAuth::getToken();
        $consumer = JWTAuth::toUser($token);
        $this->CartService->clearDetails($consumer->id);
        return response()->json("success", 200);
    }
}
