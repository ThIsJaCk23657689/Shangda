<?php

namespace App\Services\Orders;
use App\Services\BaseService;
use App\Services\Orders\PurchaseOrderService;
use App\PurchaseOrder as PurchaseOrderEloquent;
use Carbon\Carbon;

class SaleOrderService extends BaseService
{
    public $PurchaseOrderService;

    public function __construct()
    {
        $this->PurchaseOrderService = new PurchaseOrderService();
    }


    public function add($request)
    {
        // $p = PurchaseOrderEloquent::find($request->purchaseOrder_id);
        // $count = 0;
        // foreach($request->get('material_id') as $key => $val){
        //     $count += 1;
        //     $p->materials()->attach($key, [
        //         'count' => $count,
        //         'price' => $request->$val['price'], 
        //         'quantity' => $request->$val['quantity'],
        //         'subTotal' => $request->$val['subTotal'],
        //         'comment' => $request->$val['comment'],
        //         'discount' => $request->$val['discount'],
        //     ]);
        // }

        return array(
            'count' => $count,
            'id' => $request->purchaseOrder_id
        );
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