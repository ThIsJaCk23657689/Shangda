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

    public function update(PurchaseOrderDetailRequest $request, $p_id, $count)
    {
        $purchaseOrderDetail = $this->purchaseOrderDetailService->update($request,$p_id, $count);
        return response()->json($purchaseOrderDetail,200);
    }

    public function destroy($p_id, $count)
    {
        $purchaseOrderDetail = $this->purchaseOrderDetailService->delete($p_id, $count);
        return response()->json($purchaseOrderDetail,200);
    }
}
