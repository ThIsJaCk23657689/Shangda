<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SalesOrderDetailRequest;
use App\Services\Orders\SalesOrderDetailService;

class SalesOrderDetailController extends Controller
{
    public $SalesOrderDetailService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->SalesOrderDetailService = new SalesOrderDetailService();
    }

    public function store(Request $request)
    {
        $saleOrderDetail = $this->SalesOrderDetailService->add($request);
        return response()->json($saleOrderDetail, 200);
    }

    public function showDetails($saleOrder_id)
    {
        $saleOrderDetail = $this->SalesOrderDetailService->getOrderDetails($saleOrder_id);
        return response()->json($saleOrderDetail, 200);
    }

    public function update(SalesOrderDetailRequest $request, $saleOrder_id, $count)
    {
        $saleOrderDetail = $this->SalesOrderDetailService->update($request,$saleOrder_id, $count);
        return response()->json($saleOrderDetail, 200);
    }

    public function destroy($saleOrder_id, $count)
    {
        $saleOrderDetail = $this->SalesOrderDetailService->delete($saleOrder_id, $count);
        return response()->json($saleOrderDetail, 200);
    }
}
