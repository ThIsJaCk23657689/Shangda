<?php

namespace App\Services;
use App\Discount as DiscountEloquent;
use App\Product as ProductEloquent;



class DiscountService extends BaseService
{
    public function getDiscountList($id)
    {
       
        $products = ProductEloquent::select('id', 'name')->get();
        $discounts = DiscountEloquent::where('consumer_id',$id)->get();
        
        
        $results = [];
        $count = 0;
        foreach($products as $product){
            $discount_arr = [];
            $discount_exist = $discounts->where('product_id', $product->id)->first();
            if($discount_exist){
                $discount_arr['product_id'] = $product->id; 
                $discount_arr['product_name'] = $product->name; 
                $discount_arr['discount_price'] = $discount_exist->price; 
                
            }else{
                $discount_arr['product_id'] = $product->id; 
                $discount_arr['product_name'] = $product->name; 
                $discount_arr['discount_price'] = 0; 
            }
            $results[$count] = $discount_arr;
            $count += 1;
        }
    }


    public function update($requests)
    {
        $count = 1; 
        foreach ($requests as $request) {
            $basicMaterial = BasicMaterialEloquent::find($count);
            $basicMaterial->update([
                'name' => $request->name,
                'price' => $request->price,
            ]);
            $new_price[$count] = $request->price;
            $count += 1;
        }


        $products = $this->ProductService->getList();
        foreach ($products as $product) {
            $product->update([
                'retailPrice'=>$product->materialCoefficient1 * $new_price[1] + 
                $product->materialCoefficient2 * $new_price[2] + 
                $product->materialCoefficient3 * $new_price[3] +
                $product->materialCoefficient4 * $new_price[4] +
                $product->materialCoefficient5 * $new_price[5] +
                $product->fundamentalPrice
            ]);
        }


        if($basicMaterial){
            $msg = [
                'data'=>$basicMaterial,
                'status'=>'Updated'
            ];
        }else{
            $msg = [
                'data'=>$basicMaterial,
                'status'=>'Failed'
            ];
        }
        return $msg;
    }

}
