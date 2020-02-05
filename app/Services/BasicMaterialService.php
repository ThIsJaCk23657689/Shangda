<?php

namespace App\Services;

use App\BasicMaterial as BasicMaterialEloquent;
use App\Services\ProductService;

class BasicMaterialService extends BaseService
{
    public $ProductService;

    public function __construct(){
        $this->ProductService = new ProductService();
    }

    public function getList(){
        $BasicMaterials = BasicMaterialEloquent::get();
        return $BasicMaterials;
    }

    public function update($request, $id)
    {
        $basic_material = BasicMaterialEloquent::findOrFail($id);
        $basic_material->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        $this->refreshProductPrice();

        return [
            'data' => $basic_material,
            'status' => '基礎原物料已更新成功'
        ];
    }

    private function refreshProductPrice(){
        $basic_materials = BasicMaterialEloquent::get();
        foreach($basic_materials as $index => $basic_material){
            $price[$index] = $basic_material->price;
        }

        $products = $this->ProductService->getList();
        foreach ($products as $product) {
            $product->update([
                'retailPrice' => $product->materialCoefficient1 * $price[0] + 
                $product->materialCoefficient2 * $price[1] + 
                $product->materialCoefficient3 * $price[2] +
                $product->materialCoefficient4 * $price[3] +
                $product->materialCoefficient5 * $price[4] +
                $product->fundamentalPrice
            ]);
        }
    }
}
