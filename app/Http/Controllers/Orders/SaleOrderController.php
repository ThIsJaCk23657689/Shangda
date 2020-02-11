<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SaleOrderRequest;
use App\Services\Orders\SaleOrderService;

class SaleOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $SaleOrderService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->SaleOrderService = new SaleOrderService();
    }


    public function index()
    {
        $saleOrders = $this->SaleOrderService->getList();
        $lastUpdate = $this->SaleOrderService->getlastupdate();
        return view('saleOrders.index', compact('saleOrders', 'lastUpdate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('saleOrders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleOrderRequest $request)
    {
        $saleOrder = $this->SaleOrderService->add($request);
        return redirect()->route('saleOrders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $saleOrder = $this->SaleOrderService->getOne($id);
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
        $saleOrder = $this->SaleOrderService->getOne($id);
        return view('saleOrders.edit', compact('saleOrder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaleOrderRequest $request, $id)
    {
        $saleOrder = $this->SaleOrderService->update($request, $id);
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
        $this->SaleOrderService->delete($id);
        return redirect()->route('saleOrders.index');
    }

    public function delivered(Request $request){
        $msg = $this->SaleOrderService->delivered($request);
        return response()->json($msg, 200);
    }

    // 傳 id, paid_at, paidAmount
    public function paid(Request $request){
        $msg = $this->SaleOrderService->paid($request);
        return response()->json($msg, 200);
    }
}
