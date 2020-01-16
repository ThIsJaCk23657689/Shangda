<?php

namespace App\Services;
use App\Discount as DiscountEloquent;
use App\Product as ProductEloquent;



class DiscountService extends BaseService
{
    public function getDiscountList($id)
    {
        $products = ProductEloquent::get()->pluck('id','name');
        $discounts = DiscountEloquent::where('consumer_id',$id)->get();

        $users = DB::table('consumers')
            ->join('contacts', 'users.id', '=', 'contacts.user_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.*', 'contacts.phone', 'orders.price')
            ->get();


        $users = DB::table('consumers')->leftJoin(1, '=', 'discounts.consumer_id')->select('consumers.id', 'consumers.name', 'discounts.price')->get();
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
