<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseOrderDetailRequest;

use App\Services\Orders\PurchaseOrderDetailService;

class PurchaseOrderDetailController extends Controller
{
    public $PurchaseOrderDetailService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->PurchaseOrderDetailService = new PurchaseOrderDetailService();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseOrderDetailRequest $request)
    {
        $purchaseOrderDetail = $this->purchaseOrderDetailService->add($request);
        return response()->json($purchaseOrderDetail,200);
    }

    public function showDetails($p_id)
    {
        $purchaseOrderDetail = $this->purchaseOrderDetailService->getOrderDetails($p_id);
        return response()->json($purchaseOrderDetail,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PurchaseOrderDetailRequest $request, $p_id, $count)
    {
        $purchaseOrderDetail = $this->purchaseOrderDetailService->update($request,$p_id, $count);
        return response()->json($purchaseOrderDetail,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($p_id, $count)
    {
        $purchaseOrderDetail = $this->purchaseOrderDetailService->delete($p_id, $count);
        return response()->json($purchaseOrderDetail,200);
    }
}
