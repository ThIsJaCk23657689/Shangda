<?php

namespace App\Services;

use App\Product as ProductEloquent;
use App\ProductDetail as ProductDetailEloquent;


class ProductDetailService extends BaseService
{
    public function add($requests, $product_id)
    {
        $product_detail_ids = [];
        foreach($requests as $request){
            $product_detail = ProductDetailEloquent::create([
                'product_id' => $product_id,
                'material_id' => $request->material_id,
            ]);
            $product_detail_ids[] = $product_detail->id;
        }

        return $product_detail_ids;
    }

    public function getList()
    {
        $product_details = ProductDetailEloquent::get();
        return $product_details;
    }

    public function getOne($id)
    {
        $product_detail = ProductDetailEloquent::find($id);
        return $product_detail;
    }

    public function update($request, $id)
    {
        $product_detail = ProductDetailEloquent::find($id);
        if($product_detail){
            $product_detail->meterial_id = $request->meterial_id;
            $product_detail->save();

            return $product_detail;
        }else{
            return "Not Found";
        }
       
    }

    public function delete($id)
    {
        $product_detail = $this->getOne($id);
        if($product_detail){
            $product_detail->delete();
            return "Deleted";
        }else{
            return "Not Found";
        }
        
    }
}
