<?php

namespace App\Http\Controllers;
use App\Http\Requests\SaleOrderDetailRequest;
use App\Services\Orders\SaleOrderDetailService;


class SaleOrderDetailController extends Controller
{
    public $SaleOrderDetailService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->SaleOrderDetailService = new SaleOrderDetailService();
    }

    public function store(SaleOrderDetailRequest $request)
    {
        $saleOrderDetail = $this->SaleOrderDetailService->add($request);
        return response()->json($saleOrderDetail, 200);
    }

    public function showDetails($saleOrder_id)
    {
        $saleOrderDetail = $this->SaleOrderDetailService->getOrderDetails($saleOrder_id);
        return response()->json($saleOrderDetail, 200);
    }

    public function update(SaleOrderDetailRequest $request, $saleOrder_id, $count)
    {
        $saleOrderDetail = $this->SaleOrderDetailService->update($request,$saleOrder_id, $count);
        return response()->json($saleOrderDetail, 200);
    }

    public function destroy($saleOrder_id, $count)
    {
        $saleOrderDetail = $this->SaleOrderDetailService->delete($saleOrder_id, $count);
        return response()->json($saleOrderDetail, 200);
    }
}
