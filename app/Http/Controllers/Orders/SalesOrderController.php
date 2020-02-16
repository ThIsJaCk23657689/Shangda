<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SalesOrderRequest;
use App\Services\Orders\SalesOrderService;

class SalesOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $SalesOrderService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->SalesOrderService = new SalesOrderService();
    }

    public function index()
    {
        $saleOrders = $this->SalesOrderService->getList();
        $lastUpdate = $this->SalesOrderService->getlastupdate();
        return view('salesOrders.index', compact('saleOrders', 'lastUpdate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $new_shownID = $this->SalesOrderService->generateShownID();
        return view('salesOrders.create', compact('new_shownID'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SalesOrderRequest $request){
        $saleOrder = $this->SalesOrderService->add($request);
        return redirect()->route('sales.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $saleOrder = $this->SalesOrderService->getOne($id);
        return view('saleOrders.show', compact('saleOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $saleOrder = $this->SalesOrderService->getOne($id);
        return view('saleOrders.edit', compact('saleOrder'));
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
        $saleOrder = $this->SalesOrderService->update($request, $id);
        return redirect()->route('saleOrders.show', [$id]);
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
        return redirect()->route('saleOrders.index');
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
