<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SalesOrderRequest;
use App\Services\Orders\SalesOrderService;
use App\Services\Orders\ReturnOrderService;

class SalesOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $SalesOrderService;
    public $ReturnOrderService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->SalesOrderService = new SalesOrderService();
        $this->ReturnOrderService = new ReturnOrderService();
    }

    public function index()
    {
        $salesOrders = $this->SalesOrderService->getList();
        $lastUpdate = $this->SalesOrderService->getlastupdate();
        $unconfirmedList = $this->SalesOrderService->getUnconfirmedList();
        $rejectedList = $this->SalesOrderService->getRejectedList();

        return view('salesOrders.index', compact('salesOrders', 'lastUpdate','unconfirmedList','rejectedList'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($status)
    {
        $new_shownID = $this->SalesOrderService->generateShownID();
        return view('salesOrders.create', compact('new_shownID'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SalesOrderRequest $request)
    {
        $request->confirmStatus = 1;
        $request->who_created = 0;
        $salesOrder = $this->SalesOrderService->add($request);
            return response()->json([
                'salesOrder_id' => $salesOrder->id,
                'massenge' => '單號' . $salesOrder->shown_id . '建立成功。',
                'status' => 'OK'
            ]);
    }

    public function storeFromCart(SalesOrderRequest $request)
    {
        //顧客申請狀態
        $request->confirmStatus = 0;
        $request->who_created = 1;

        $salesOrder = $this->SalesOrderService->add($request);
        return response()->json([
            'salesOrder_id' => $salesOrder->id,
            'massenge' => '單號' . $salesOrder->shown_id . '建立成功。',
            'status' => 'OK'
        ]); 
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $salesOrder = $this->SalesOrderService->getOne($id);
        return view('salesOrders.show', compact('salesOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $salesOrder = $this->SalesOrderService->getOne($id);
        return view('salesOrders.edit', compact('salesOrder'));
    }

    public function confirmOrder($id,$status)
    {
        $salesOrder = $this->SalesOrderService->confirmOrder($id,$status);
        return view('salesOrders.edit', compact('salesOrder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SalesOrderRequest $request, $id)
    {
        $status = $request->status;
        $salesOrder = $this->SalesOrderService->update($request, $id);

        return redirect()->route('salesOrders.show', [$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->SalesOrderService->delete($id);
        return redirect()->route('salesOrders.index');
    }

    public function delivered(Request $request){
        $msg = $this->SalesOrderService->delivered($request);
        return response()->json($msg, 200);
    }

    // 傳 id, paid_at, paidAmount
    public function paid(Request $request){
        $msg = $this->SalesOrderService->paid($request);
        return response()->json($msg, 200);
    }

    // 取消付款 傳id
    public function paymentCancel(Request $request){
        $msg = $this->SalesOrderService->paymentCancel($request);
        return response()->json($msg, 200);
    }

}
