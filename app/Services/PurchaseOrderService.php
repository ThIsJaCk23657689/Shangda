<?php

namespace App\Services;
use App\PurchaseOrder as PurchaseOrderEloquent;

class PurchaseOrderService extends BaseService
{
    public function add($request)
    {
        $purchaseOrder = PurchaseOrderEloquent::create([
            'supplier_id' => $request->supplier_id,
            'user_id' => $request->user_id,
            'paid_at' => $request->paid_at,
            'received_at' => $request->received_at,
            'expectReceived_at' => $request->expectReceived_at,
            'totalPrice' => $request->totalPrice,
            'comment' => $request->comment,
            'taxType' => $request->taxType,
            'invoiceType' => $request->invoiceType,
            'address' => $request->address,
        ]);
        return $purchaseOrder;
    }

    public function getList()
    {
        $purchaseOrders = PurchaseOrderEloquent::get();
        return $purchaseOrders;
    }

    public function getOne($id)
    {
        $purchaseOrder = PurchaseOrderEloquent::find($id);
        return $purchaseOrder;
    }

    public function update($request, $id)
    {
        $purchaseOrder = $this->getOne($id);
        $purchaseOrder->update([
            'supplier_id' => $request->supplier_id,
            'user_id' => $request->user_id,
            'paid_at' => $request->paid_at,
            'received_at' => $request->received_at,
            'expectReceived_at' => $request->expectReceived_at,
            'totalPrice' => $request->totalPrice,
            'comment' => $request->comment,
            'taxType' => $request->taxType,
            'invoiceType' => $request->invoiceType,
            'address' => $request->address,
        ]);
        return $purchaseOrder;
    }

    public function delete($id)
    {
        $purchaseOrder = $this->getOne($id);
        $purchaseOrder->delete();
    }

    public function getlastupdate()
    {
        $purchaseOrder = PurchaseOrderEloquent::orderBy('id', 'DESC')->first();
        if(!empty($purchaseOrder)){
            return $purchaseOrder->updated_at;
        }

        return null;
    }
}
