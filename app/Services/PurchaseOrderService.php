<?php

namespace App\Services;
use App\PurchaseOrder as PurchaseOrderEloquent;
use Carbon\Carbon;

class PurchaseOrderService extends BaseService
{
    public function add($request)
    {
        $today = Carbon::today()->toDateTimeString();   //2019-12-26 00:00:00
        $today = substr($today, 0, 10);                 //2019-12-26
        $today = str_replace('-','',$today);            //20191226
        $count = PurchaseOrderEloquent::where('shown_id','P20191226%')->count();
        $count += 1;
        $count = str_pad($count, 4, '0', STR_PAD_LEFT);
        $shown_id = 'P'.$today.$count;

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
