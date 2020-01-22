<?php

namespace App\Services;

use App\Produce as ProduceEloquent;
use App\Product as ProductEloquent;
use App\ProductLog as ProductLogEloquent;
use Auth;

class ProduceService extends BaseService
{
    public function add($request)
    {
        $product = ProductEloquent::findOrFail($request->product_id);
        $produce = ProduceEloquent::create([
            'product_id' => $request->product_id,
            'quantity' => $request->product_quantity,
            'user_id' => Auth::id(),
            'last_user_id' => Auth::id()
        ]);

        if($produce){
            // 更改商品存貨量
            $product->quantity = $product->quantity + $request->product_quantity;
            if($product->quantity < 0){
                throw new Exception('Quantity Not Enough.');
            }
            $product->save();

            //新增商品存貨Log
            $ProductLog = ProductLogEloquent::create([
                'user_id' => Auth::id(),
                'product_id'=> $request->product_id,
                'act' => 4,
                'amount' => $request->product_quantity
            ]);
            return $produce;
        }else{
            throw new Exception('Create Produce Failed');
        }
    }

    public function getList()
    {
        $produces = ProduceEloquent::get();
        return $produces;
    }

    public function getOne($id)
    {
        $produce = ProduceEloquent::find($id);
        return $produce;
    }

    public function update($request, $id)
    {
        $product = ProductEloquent::find($request->product_id);
        if($product){
            $produce = $this->getOne($id);
            if($produce){
                $orig_quantity = $produce->quantity;
                $produce->update([
                    'quantity ' => $request->quantity,
                    'last_user_id' => Auth::id()
                ]);
            }else{
                return "Produce Not Found";
            }
        }else{
            return "Product Not Found";
        }
        if($produce && $product){
            // 更改商品存貨量
            $product->quantity = $product->quantity - $orig_quantity + $request->quantity;
            $product->save();

            //新增商品存貨Log
            $ProductLog = ProductLogEloquent::create([
                'user_id' => Auth::id(),
                'product_id'=> $request->product_id,
                'act' => 5,
                'amount' => $orig_quantity - $request->quantity
            ]);
            return $produce;
        }else{
            return "Failed";
        }
    }

    public function delete($id)
    {
        $produce = $this->getOne($id);
        $product = ProductEloquent::find($produce->product_id);

        if($produce){
            $orig_quantity = $produce->quantity;
            $product = ProductEloquent::find($produce->product_id);
            if($product){
                // 更改商品存貨量
                $product->quantity = $product->quantity - $produce->quantity;
                $product->save();
            }else{
                return "Product Not Found";
            }
        }else{
            return "Produce Not Found";
        }

        if($produce && $product){
            //新增商品存貨Log
            $ProductLog = ProductLogEloquent::create([
                'user_id' => Auth::id(),
                'product_id'=> $produce->product_id,
                'act' => 6,
                'amount' => (-1) * $orig_quantity
            ]);
            $produce->delete();
        }else{
            return "Failed";
        }
    }

    public function getlastupdate()
    {
        $produce = ProduceEloquent::orderBy('id', 'DESC')->first();
        if(!empty($produce)){
            return $produce->updated_at;
        }
        return null;
    }
}
