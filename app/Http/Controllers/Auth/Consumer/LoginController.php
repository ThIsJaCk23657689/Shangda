<?php

namespace App\Http\Controllers\Auth\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\ConsumerService;
use App\Services\Orders\SalesOrderService;
use Illuminate\Validation\Rule;
use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    public $ConsumerService;
    public $SalesOrderService;
    protected $redirectTo = '/';

    public function __construct(){
        $this->middleware('guest:api')->except('logout');
        $this->ConsumerService = new ConsumerService();
        $this->SalesOrderService = new SalesOrderService();
    }

    // 客戶登入頁面
    public function showLoginForm(){
        return view('frontend.consumers.login');
    }

    // 客戶個人資料頁面
    public function showProfile($id){
        $consumer = $this->ConsumerService->getOne($id);
        return view('frontend.consumers.profile', compact('consumer'));
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
