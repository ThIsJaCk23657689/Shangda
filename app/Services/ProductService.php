<?php

namespace App\Services;
use App\Product as ProductEloquent;
use Carbon\Carbon;

class ProductService extends BaseService
{
    public function add($request)
    {
        $product = ProductEloquent::create([
            'name' => $request->name,
            'shortName' => $request->shortName,
            'internationalNum' => $request->internationalNum,

            'fundamentalPrice' => $request->fundamentalPrice,
            'retailPrice' => $request->retailPrice,
            'materialCoefficient1' => $request->materialCoefficient1,
            'materialCoefficient2' => $request->materialCoefficient2,
            'materialCoefficient3' => $request->materialCoefficient3,
            'materialCoefficient4' => $request->materialCoefficient4,
            'materialCoefficient5' => $request->materialCoefficient5,

            'comment' => $request->comment,
            'unit' => $request->unit,
            'quantity' => $request->quantity,
            'safeQuantity' => $request->safeQuantity,
            'picture' => $request->picture,
            'intro' => $request->intro,
            'specification' => $request->specification,

        ]);

        return $product;
    }

    public function getList()
    {
        $products = ProductEloquent::get();
        return $products;
    }

    public function getOne($id)
    {
        $product = ProductEloquent::find($id);
        return $product;
    }

    public function update($request, $id)
    {
        $product = $this->getOne($id);
        $product->update([
            'name' => $request->name,
            'shortName' => $request->shortName,
            'internationalNum' => $request->internationalNum,

            'fundamentalPrice' => $request->fundamentalPrice,
            'retailPrice' => $request->retailPrice,
            'materialCoefficient1' => $request->materialCoefficient1,
            'materialCoefficient2' => $request->materialCoefficient2,
            'materialCoefficient3' => $request->materialCoefficient3,
            'materialCoefficient4' => $request->materialCoefficient4,
            'materialCoefficient5' => $request->materialCoefficient5,

            'comment' => $request->comment,
            'unit' => $request->unit,
            'quantity' => $request->quantity,
            'safeQuantity' => $request->safeQuantity,
            'picture' => $request->picture,
            'intro' => $request->intro,
            'specification' => $request->specification,
        ]);
        return $product;
    }

    public function delete($id)
    {
        $product = $this->getOne($id);
        $product->delete();
    }

    public function getlastupdate()
    {
        $product = ProductEloquent::orderBy('id', 'DESC')->first();
        if(!empty($product)){
            return $product->updated_at;
        }

        return null;
    }
}
