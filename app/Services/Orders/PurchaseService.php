<?php

namespace App\Services\Orders;

use App\Services\BaseService;
use App\PurchaseOrder as PurchaseOrderEloquent;

class PurchaseService extends BaseService
{
    public function add($request)
    {
        $purchaseOrder = PurchaseOrderEloquent::create([
            
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