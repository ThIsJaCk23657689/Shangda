<?php

namespace App\Services;
use App\ProductQuantity as ProductQuantityEloquent;
use App\Product as ProductEloquent;
use App\Product_log as Product_logEloquent;
use Auth;

class ProductQuantityService extends BaseService
{

    public $Material_logService;

    public function __construct()
    {
        $this->Material_logService = new Material_logService();
    }

    public function add($request)
    {
        $product = ProductEloquent::find($request->product_id);
        if($product){
            $productQuentity = ProductQuantityEloquent::create([
                        'product_id' => $request->product_id,
                        'quantity ' => $request->quantity,
                        'user_id' => Auth::id(),
                        'last_user_id' => Auth::id()
            ]);
            if($productQuentity){
                // 更改商品存貨量
                $product->quantity = $product->quantity + $request->quantity;
                if($product->quantity < 0){
                    return 'Quantity Not Enough';
                }
                $product->save();

                //新增商品存貨Log
                $product_log = Product_logEloquent::create([
                    'user_id' => Auth::id(),
                    'product_id'=> $request->product_id,
                    'act' => 4,
                    'amount' => $request->quantity
                ]);
                return $productQuentity;
            }else{
                return "Failed";
            }
        }else{
            return "Product Not Found";
        }

    }

    public function getList()
    {
        $productQuentities = ProductQuantityEloquent::get();
        return $productQuentities;
    }

    public function getOne($id)
    {
        $productQuentity = ProductQuantityEloquent::find($id);
        return $productQuentity;
    }

    public function update($request, $id)
    {

        $product = ProductEloquent::find($request->product_id);
        if($product){
            $productQuentity = $this->getOne($id);
            if($productQuentity){
                $orig_quantity = $productQuentity->quantity;
                $productQuentity->update([
                    'quantity ' => $request->quantity,
                    'last_user_id' => Auth::id()
                ]);
            }else{
                return "ProductQuantity Not Found";
            }
        }else{
            return "Product Not Found";
        }


        if($productQuentity && $product){
            // 更改商品存貨量
            $product->quantity = $product->quantity - $orig_quantity + $request->quantity;
            $product->save();

            //新增商品存貨Log
            $product_log = Product_logEloquent::create([
                'user_id' => Auth::id(),
                'product_id'=> $request->product_id,
                'act' => 5,
                'amount' => $orig_quantity - $request->quantity
            ]);
            return $productQuentity;
        }else{
            return "Failed";
        }



    }

    public function delete($id)
    {
        $productQuentity = $this->getOne($id);
        $product = ProductEloquent::find($productQuentity->product_id);

        if($productQuentity){
            $orig_quantity = $productQuentity->quantity;
            $product = ProductEloquent::find($productQuentity->product_id);
            if($product){
                // 更改商品存貨量
                $product->quantity = $product->quantity - $productQuentity->quantity;
                $product->save();
            }else{
                return "Product Not Found";
            }
        }else{
            return "ProductQuantity Not Found";

        }


        if($productQuentity && $product){
            //新增商品存貨Log
            $product_log = Product_logEloquent::create([
                'user_id' => Auth::id(),
                'product_id'=> $productQuentity->product_id,
                'act' => 6,
                'amount' => (-1) * $orig_quantity
            ]);

            $productQuentity->delete();
        }else{
            return "Failed";
        }

    }

    public function getlastupdate()
    {
        $productQuentity = ProductQuantityEloquent::orderBy('id', 'DESC')->first();
        if(!empty($productQuentity)){
            return $productQuentity->updated_at;
        }
        return null;
    }
}
