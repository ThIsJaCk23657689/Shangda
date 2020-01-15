<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PurchaseOrderDetailRequest;

use App\Services\Orders\PurchaseOrderDetailService;

class PurchaseOrderDetailController extends Controller
{
    public $PurchaseOrderDetailService;

    public function __construct()
    {
        // $this->middleware('auth');
        $this->PurchaseOrderDetailService = new PurchaseOrderDetailService();
    }

    public function store(Request $request)
    {
        $purchaseOrderDetail = $this->PurchaseOrderDetailService->add($request);
        return response()->json($purchaseOrderDetail, 200);
    }

    public function showDetails($p_id)
    {
        $purchaseOrderDetail = $this->PurchaseOrderDetailService->getOrderDetails($p_id);
        return response()->json($purchaseOrderDetail, 200);
    }

    public function update(PurchaseOrderDetailRequest $request, $p_id, $count)
    {
        $purchaseOrderDetail = $this->PurchaseOrderDetailService->update($request,$p_id, $count);
        return response()->json($purchaseOrderDetail,200);
    }

    public function destroy($p_id, $count)
    {
        $purchaseOrderDetail = $this->PurchaseOrderDetailService->delete($p_id, $count);
        return response()->json($purchaseOrderDetail,200);
    }
}
