<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PurchaseOrderRequest;
use App\Services\Orders\PurchaseOrderService;

class PurchaseOrderController extends Controller
{

    public $PurchaseOrderService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->PurchaseOrderService = new PurchaseOrderService();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseOrders = $this->PurchaseOrderService->getList();
        $lastUpdate = $this->PurchaseOrderService->getlastupdate();
        return view('purchaseOrder.index', compact('purchaseOrders', 'lastUpdate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('purchaseOrder.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseOrderRequest $request)
    {
        $purchaseOrder = $this->PurchaseOrderService->add($request);
        return response()->json([
            'purchaseOrder_id' => $purchaseOrder->id,
            'massenge' => '單號' . $purchaseOrder->shown_id . '建立成功。',
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
        $purchaseOrder = $this->PurchaseOrderService->getOne($id);
        return view('purchaseOrder.show', compact('purchaseOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchaseOrder = $this->PurchaseOrderService->getOne($id);
        return view('purchaseOrder.edit', compact('purchaseOrder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PurchaseOrderRequest $request, $id)
    {
        $purchaseOrder = $this->PurchaseOrderService->update($request, $id);
        return redirect()->route('purchase.show', [$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->PurchaseOrderService->delete($id);
        return redirect()->route('purchase.index');
    }

    public function received(Request $request){
        $msg = $this->PurchaseOrderService->received($request);
        return response()->json($msg, 200);
    }
}
