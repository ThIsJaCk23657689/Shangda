<?php

namespace App\Services\Orders;
use App\Services\BaseService;
use App\Services\Orders\PurchaseOrderService;
use App\PurchaseOrder as PurchaseOrderEloquent;
use App\PurchaseOrderDetail as PurchaseOrderDetailEloquent;

use Carbon\Carbon;

class PurchaseOrderDetailService extends BaseService
{
    public function add($request)
    {
        $p_id = $request->purchaseOrder_id;
        $data = $request->data;
        $count = 0;
        foreach($data as $obj){
            $count += 1;
            $purchaseOrderDetail = PurchaseOrderDetail::create([
                'purchaseOrder_id' => $p_id,
                'count' => $count,

                'material_id' => $obj->material_id,
                'price' => $obj->price,
                'quantity' => $obj->quantity,
                'discount' => $obj->discount,
                'subTotal' => $obj->subTotal,
                'comment' => $obj->comment,
            ]);
        }
        if($purchaseOrderDetail){
            $msg = [
                'massenge'=>"總共有".$count."筆資料新增成功。",
                'status'=>'OK'
            ];
        }else{
            $msg = [
                'massenge'=>"無資料新增。",
                'status'=>'Failed'
            ];
        }
        return $msg;
    }


    public function update($request, $order_id, $count)
    {
        $details = PurchaseOrderEloquent::find($order_id)->materials();
        $detail = $details->where('count', $count);

        $detail->update([

        ]);

        $saleOrder->update([
            'consumers_id' => $request->consumers_id,
            'user_id' => $request->user_id,

            'expectPay_at' => $request->expectPay_at,
            'paid_at' => $request->paid_at,
            'expectDeliver_at' => $request->expectDeliver_at,
            'delivered_at' => $request->delivered_at,
            'makeInvoice_at' => $request->makeInvoice_at,

            'piadAmount' => $request->piadAmount,
            'unpiadAmount' => $request->unpiadAmount,
            'totalPrice' => $request->totalPrice,
            'taxPrice' => $request->taxPrice,
            'totalTaxPrice' => $request->totalTaxPrice,

            'comment' => $request->comment,
            'taxType' => $request->taxType,
            'invoiceType' => $request->invoiceType,
            'address' => $request->address,
        ]);
        return $saleOrder;
    }

    public function delete($id)
    {
        $saleOrder = $this->getOne($id);
        $saleOrder->delete();
    }

    public function getlastupdate()
    {
        $saleOrder = SaleOrderEloquent::orderBy('id', 'DESC')->first();
        if(!empty($saleOrder)){
            return $saleOrder->updated_at;
        }

        return null;
    }
}