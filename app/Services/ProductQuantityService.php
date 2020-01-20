<?php

namespace App\Services;
use App\ProductQuantity as ProductQuantityEloquent;

class ProductQuantityService extends BaseService
{
    public function add($request)
    {
        $pq = ProductQuantityEloquent::create([
            'product_id' => $request->product_id,
            'quantity ' => $request->quantity
        ]);

        return $pq;
    }

    public function getList()
    {
        $pqs = ProductQuantityEloquent::get();
        return $pqs;
    }

    public function getOne($id)
    {
        $pq = ProductQuantityEloquent::find($id);
        return $pq;
    }

    public function update($request, $id)
    {
        $pq = $this->getOne($id);

        $pq->update([
            'product_id' => $request->product_id,
            'quantity ' => $request->quantity
        ]);
        return $pq;
    }

    public function delete($id)
    {
        $pq = $this->getOne($id);
        $pq->delete();
    }

    public function getlastupdate()
    {
        $pq = ProductQuantityEloquent::orderBy('id', 'DESC')->first();
        if(!empty($pq)){
            return $pq->updated_at;
        }
        return null;
    }
}
