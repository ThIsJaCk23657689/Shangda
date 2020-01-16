<?php

namespace App\Services;
use App\BasicMaterial as BasicMaterialEloquent;
use App\Services\ProductService;


class BasicMaterialService extends BaseService
{
    public $ProductService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->ProductService = new ProductService();
    }

    public function getList()
    {
        $basicMaterials = BasicMaterialEloquent::get();

        if($basicMaterials){
            $msg = [
                'data'=>$basicMaterials,
                'status'=>'OK'
            ];
        }else{
            $msg = [
                'data'=>$basicMaterials,
                'status'=>'Failed'
            ];
        }
        return $msg;
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
            $new_price[count] = $request->price;
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
