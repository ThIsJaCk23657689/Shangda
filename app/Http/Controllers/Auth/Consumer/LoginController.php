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
    }

    // 客戶登入頁面
    public function showLoginForm(){
        return view('frontend.consumers.login');
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

    // // 客戶個人資料頁面
    // public function showProfile($id){
    //     $consumer = $this->ConsumerService->getOne($id);
    //     return view('frontend.consumers.profile', compact('consumer'));
    // }

    // // 客戶訂單index
    // public function showSaleOrders($consumer_id){
    //     // $sale_orders = $this->ConsumerService->getOne($consumer_id)->saleOrder;
    //     return view('frontend.consumers.sale_orders', compact('consumer_id'));
    // }

    // public function getSaleOrdersFrontend(Request $request){
    //     $this->validate($request, [
    //         'skip' => 'nullable| integer|',
    //         'status' => [
    //             'nullable',
    //             Rule::in([1, 2, 3, 4, 0]), //type:(default) 0.所有訂單 1.未付款未出貨訂單 2.已付款未出貨訂單 3.未付款已出貨訂單 4.已完成訂單
    //         ],
    //         'consumer_id' => 'required'
    //     ]);

    //     $res = $this->ConsumerService->getSaleOrdersFrontend($request);

    //     return response()->json([
    //         'status' => 'OK',
    //         'totalcount' => $res['count'],
    //         'sale_orders' => $res['sale_orders'],
    //     ]);
    // }

    // //  客戶訂單details
    // public function showSaleOrderDetails($consumer_id, $sale_orders_id){
    //     $details = $this->ConsumerService->getSaleOrderDetails($sale_orders_id);
    //     $c = 1;
    //     foreach($details as $detail){
    //         $detail->index = $c;
    //         $c++;
    //     }
    //     $sale_order = $this->SalesOrderService->getOne($sale_orders_id);
    //     return view('frontend.consumers.sale_order_detail', compact('details', 'sale_order'));
    // }
}