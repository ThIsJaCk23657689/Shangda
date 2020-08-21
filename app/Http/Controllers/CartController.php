<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\CartService;
use App\Services\ProductService;
use App\Services\Orders\SalesOrderService;
use App\Http\Requests\CartRequest;
use App\SalesOrder as SalesOrderEloquent;
use App\SalesOrderDetail as SalesOrderDetailEloquent;
use Auth;

class CartController extends Controller
{
    public $CartService;
    public $ProductService;
    public $SalesOrderService;

    public function __construct()
    {
        $this->middleware('auth:consumer');
        $this->CartService = new CartService();
        $this->ProductService = new ProductService();
        $this->SalesOrderService = new SalesOrderService();
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

    // 刪除商品到購物車
    public function removeProductToCart(Request $request){
        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
        ]);

        $consumer = Auth::guard('consumer')->user();
        $cart = $consumer->cart;
        $cart->products()->detach($request->product_id);

        return response()->json([
            'message' => '已成功移除該商品！'
        ], 200);
    }

    public function updateProductQty(Request $request){
        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:999',
        ]);

        $consumer = Auth::guard('consumer')->user();
        $cart = $consumer->cart;
        $product = $this->ProductService->getOne($request->product_id);
        
        $overflowMsg = '';
        if($product->quantity < $request->quantity){
            // 庫存 小於 需求
            $quantity = $product->quantity;
            $overflowMsg = '超過商品僅有庫存！';
        }else{
            $quantity = $request->quantity;
        }

        $cart->products()->updateExistingPivot($request->product_id,[
            'price' => $product->retailPrice,
            'quantity' => $quantity,
            'subTotal' => $product->retailPrice * $quantity,
        ]);
        
        // $availableQty = $product->quantity - $product->safeQuantity;
        // if($availableQty > $request->quantity){
        // }else if($availableQty <= 0){
        // }

        return response()->json([
            'message' => '已成功更新該商品的購買數量！',
            'overflowMsg' => $overflowMsg,
            'realQty' => $quantity
        ], 200);
    }

    public function getOne(){
        $consumer = Auth::guard('consumer')->user();

        // 查看是否已經有購物車
        if($consumer->cart()->count() == 0){
            // 如果沒有就生成一個購物車
            $cart = $this->CartService->add($consumer->id);
        }else{
            $cart = $consumer->cart;
        }
        $products = $cart->products;

        foreach($products as $product){
            $product->showUnit = $product->showUnit();
            $product->showURL = route('front.products.show', $product->id);
            $product->pictures = $product->pictures;
            $product->category = $product->category;
            $product->coverImage = $product->showPicture(1);
        }

        return response()->json([
            'products' => $products,
        ], 200);
    }

    public function checkout(Request $request){

        $consumer = Auth::guard('consumer')->user();

        // 創建訂單 confirmStatus=>0(未確認) who_created=>1(客戶創建)
        $shownID = $this->SalesOrderService->generateShownID();
        $order = SalesOrderEloquent::create([
            'consumer_id' => $consumer->id,
            'shown_id' => $shownID,
            'user_id' => $consumer->id,
            'last_user_id' => $consumer->id,

            // 'expectPay_at' => $request->expectPay_at,
            // 'expectDeliver_at' => $request->expectDeliver_at,
            // 'makeInvoice_at' => $request->makeInvoice_at,

            // 'comment' => $request->comment,
            // 'taxType' => $request->taxType,
            'status' => 1, // 1代表出貨
            // 'invoiceType' => $request->invoiceType,
            'address' => $consumer->showAddress(),
            'confirmStatus' => 0,
            'who_created' => 1,
        ]);
        
        $count = 0;
        $total_unTax = 0;
        foreach($request->carts as $cart){
            $count++;

            $price = $cart['product']['retailPrice'];
            $quantity = $cart['quantity'];
            $subTotal = round($price * $quantity, 4);
            $total_unTax += $subTotal;

            SalesOrderDetailEloquent::create([
                'sales_order_id' => $order->id,
                'count' => $count,
                'product_id' => $cart['product']['id'],
                'price' => $price,
                'quantity' => $quantity,
                'discount' => 1,
                'subTotal' => $subTotal,
                // 'comment' => $obj['comment'],
            ]);
        }

        $add_price = 0;
        $order->totalPrice = $total_unTax;
        if($order->taxType == 1){
            $order->taxPrice = $total_unTax * 0.05;
            $order->totalTaxPrice = $total_unTax * 1.05;
            $order->unpaidAmount = $total_unTax * 1.05;
            $add_price = $total_unTax * 1.05;
        }else{
            $order->taxPrice = 0;
            $order->totalTaxPrice = $total_unTax;
            $order->unpaidAmount = $total_unTax;
            $add_price = $total_unTax;
        }
        $order->save();
        $order->consumer->uncheckedAmount += $add_price;
        $order->consumer->totalConsumption += $add_price;
        $order->consumer->save();

        $cart = $consumer->cart;
        $cart->products()->detach();

        return response()->json([
            'message' => "銷貨單編號：$shownID 新增成功。",
            'status' => 'OK'
        ], 200);
    }

    // public function clearCartDetails(){
    //     $token = JWTAuth::getToken();
    //     $consumer = JWTAuth::toUser($token);
    //     $this->CartService->clearDetails($consumer->id);
    //     return response()->json("success", 200);
    // }
}
