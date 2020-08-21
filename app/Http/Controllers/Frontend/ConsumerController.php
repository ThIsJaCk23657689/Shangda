<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ConsumerService;
use App\Services\CartService;
use Auth;
use Illuminate\Validation\Rule;

class ConsumerController extends Controller
{

    public $ConsumerService;
    public $CartService;

    public function __construct()
    {
        $this->middleware('auth:consumer');
        $this->ConsumerService = new ConsumerService();
        $this->CartService = new CartService();
    }

    // 客戶個人資料頁面
    public function showProfile($id){

        if($id != Auth::guard('consumer')->id()){
            // 顧客不能查看非自己的個人資料
            return redirect()->route('index');
        }

        $consumer = $this->ConsumerService->getOne($id);
        return view('frontend.consumers.profile', compact('consumer'));
    }

    public function showCart($id){

        if($id != Auth::guard('consumer')->id()){
            // 顧客不能查看非自己的購物車
            return redirect()->route('index');
        }

        // 查看是否已經有購物車
        $consumer = $this->ConsumerService->getOne($id);
        if($consumer->cart()->count() == 0){
            // 如果沒有就生成一個購物車
            $cart = $this->CartService->add($consumer->id);
        }else{
            $cart = $consumer->cart;
        }

        return view('frontend.consumers.cart', compact('consumer', 'cart'));
    }

    // 客戶訂單index
    public function showSaleOrders($consumer_id){
        // $sale_orders = $this->ConsumerService->getOne($consumer_id)->saleOrder;
        return view('frontend.consumers.sale_orders', compact('consumer_id'));
    }

    public function getSaleOrdersFrontend(Request $request){
        $this->validate($request, [
            'skip' => 'nullable| integer|',
            'status' => [
                'nullable',
                Rule::in([1, 2, 3, 4, 0]), //type:(default) 0.所有訂單 1.未付款未出貨訂單 2.已付款未出貨訂單 3.未付款已出貨訂單 4.已完成訂單
            ],
            'consumer_id' => 'required'
        ]);

        $res = $this->ConsumerService->getSaleOrdersFrontend($request);

        return response()->json([
            'status' => 'OK',
            'totalcount' => $res['count'],
            'sale_orders' => $res['sale_orders'],
        ]);
    }

    //  客戶訂單details
    public function showSaleOrderDetails($consumer_id, $sale_orders_id){
        $details = $this->ConsumerService->getSaleOrderDetails($sale_orders_id);
        $c = 1;
        foreach($details as $detail){
            $detail->index = $c;
            $c++;
        }
        $sale_order = $this->SalesOrderService->getOne($sale_orders_id);
        return view('frontend.consumers.sale_order_detail', compact('details', 'sale_order'));
    }
}
