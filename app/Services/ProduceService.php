<?php

namespace App\Services;

use App\Produce as ProduceEloquent;
use App\ProduceDetail as ProduceDetailEloquent;
use App\ProduceProduct as ProduceProductEloquent;
// use App\Product as ProductEloquent;
// use App\ProductLog as ProductLogEloquent;
// use App\Services\NotificationService;
use App\Services\ProduceDetailService;
use Auth;

class ProduceService extends BaseService
{
    public $ProduceDetailService;

    public function __construct(){
        $this->ProduceDetailService = new ProduceDetailService();
        // $this->NotificationService->materialUnderSafe($material_id);
    }

    public function add($request)
    {
        // $product = ProductEloquent::findOrFail($request->product_id);
        $produce = ProduceEloquent::create([
            'product_id' => $request->product_id,
            'quantity' => $request->product_quantity,
            'user_id' => Auth::id(),
            'last_user_id' => Auth::id()
        ]);
        if($produce){
            return $produce;
        }else{
            throw new Exception('Create Produce Failed');
        }

        // if($produce){
        //     // 更改商品存貨量
        //     $product->quantity = $product->quantity + $request->product_quantity;
        //     if($product->quantity < 0){
        //         throw new Exception('Quantity Not Enough.');
        //     }
        //     $product->save();

        //     //新增商品存貨Log
        //     $ProductLog = ProductLogEloquent::create([
        //         'user_id' => Auth::id(),
        //         'product_id'=> $request->product_id,
        //         'act' => 4,
        //         'amount' => $request->product_quantity
        //     ]);
        //     return $produce;
        // }else{
        //     throw new Exception('Create Produce Failed');
        // }
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
        $produce = $this->getOne($id);
        if($produce){
            $orig_quantity = $produce->quantity;
            $produce->update([
                'quantity ' => $request->quantity,
                'last_user_id' => Auth::id()
            ]);
            return ['status'=> 200 , 'message'=> "修改成功", 'url'=>route('produces.show', $id)];
        }else{
            return ['status'=> 401 , 'message'=> "查無此生產單", 'url'=>route('produces.show', $id)];
        }

        // $product = ProductEloquent::find($request->product_id);
        // if($product){
        //     $produce = $this->getOne($id);
        //     if($produce){
        //         $orig_quantity = $produce->quantity;
        //         $produce->update([
        //             'quantity ' => $request->quantity,
        //             'last_user_id' => Auth::id()
        //         ]);
        //     }else{
        //         return "Produce Not Found";
        //     }
        // }else{
        //     return "Product Not Found";
        // }
        // if($produce && $product){
        //     // 更改商品存貨量
        //     $product->quantity = $product->quantity - $orig_quantity + $request->quantity;
        //     $product->save();

        //     //新增商品存貨Log
        //     $ProductLog = ProductLogEloquent::create([
        //         'user_id' => Auth::id(),
        //         'product_id'=> $request->product_id,
        //         'act' => 5,
        //         'amount' => $orig_quantity - $request->quantity
        //     ]);
        //     return $produce;
        // }else{
        //     return "Failed";
        // }
    }

    public function delete($id)
    {
        $produce = $this->getOne($id);
        $detail_material_ids = ProduceDetailEloquent::where('produce_id', $id)->get();
        $detail_product_ids = ProduceProductEloquent::where('produce_id', $id)->get();

        foreach($detail_material_ids as $detail_material_id){
            $this->ProduceDetailService->materialDelete($detail_material_id);
        }
        foreach($detail_product_ids as $detail_product_id){
            $this->ProduceDetailService->productDelete($detail_product_id);
        }
        $produce->delete();
        // $product = ProductEloquent::find($produce->product_id);

        // if($produce){
        //     $orig_quantity = $produce->quantity;
        //     $product = ProductEloquent::find($produce->product_id);
        //     if($product){
        //         // 更改商品存貨量
        //         $product->quantity = $product->quantity - $produce->quantity;
        //         $product->save();
        //     }else{
        //         return "Product Not Found";
        //     }
        // }else{
        //     return "Produce Not Found";
        // }

        // if($produce && $product){
        //     //新增商品存貨Log
        //     $ProductLog = ProductLogEloquent::create([
        //         'user_id' => Auth::id(),
        //         'product_id'=> $produce->product_id,
        //         'act' => 6,
        //         'amount' => (-1) * $orig_quantity
        //     ]);
        //     $produce->delete();
        // }else{
        //     return "Failed";
        // }
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
