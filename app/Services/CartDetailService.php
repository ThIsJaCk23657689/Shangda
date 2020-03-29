<?php

namespace App\Services\Orders;

use App\Services\BaseService;
use App\CartDetail as CartDetailEloquent;
use App\Cart as CartEloquent;
use JWTAuth;

class CartDetailService extends BaseService
{

    public function __construct(){
        //
    }

    public function add($request){
        // 透過JWTtoken抓使用者
        // $token = JWTAuth::getToken();
        // $consumer = JWTAuth::toUser($token);

        $cart_id = $request->cart_id;
        $cart = CartEloquent::findOrFail($cart_id);
        $details = CartDetailEloquent::where('cart_id', $cart_id)->orderBy('coount', 'desc')->first();
        if($details){
            $count = $details->count + 1;
        }else{
            $count = 1;
        }

        $subTotal = round($request->price * $request->discount * $request->quantity, 4);

        $cartDetail = CartDetailEloquent::create([
            'sales_order_id' => $cart_id,
            'count' => $count,
            'product_id' => $request->product_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'discount' => $request->discount,
            'subTotal' => $subTotal,
            'comment' => $request->comment,
        ]);


        if($cartDetail){

            $cart->totalTaxPrice += $subTotal;
            $cart->save();
            $msg = [
                'messenge' => "新增購物車細項成功",
                'status' => 'OK'
            ];
        }else{
            $msg = [
                'messenge'=> "新增購物車細項時發生錯誤",
                'status' => 'Failed'
            ];
        }
        return $msg;
    }

    public function getListbyCartId($cart_id){
        $details = CartDetailEloquent::where('cart_id',$cart_id)->get();
        if($details){
            $msg = [
                'data'=>$details,
                'status'=>'OK'
            ];
        }else{
            $msg = [
                'data'=>$details,
                'status'=>'No data exist.'
            ];
        }
        return $msg;
    }

    public function getListByConsumerId($consumer_id){
        $details = CartDetailEloquent::where('consumer_id',$consumer_id)->get();
        if($details){
            $msg = [
                'data'=>$details,
                'status'=>'OK'
            ];
        }else{
            $msg = [
                'data'=>$details,
                'status'=>'No data exist.'
            ];
        }
        return $msg;
    }

    public function getOne($id){
        $detail = CartDetailEloquent::findOrFail($id);
        if($detail){
            $msg = [
                'data'=>$detail,
                'status'=>'OK'
            ];
        }else{
            $msg = [
                'data'=>$detail,
                'status'=>'No data exist.'
            ];
        }
        return $msg;
    }



    public function update($request, $id){
        $details = CartDetailEloquent::findOrFail($id);
        $cart = CartDetailEloquent::where('id', $details->cart_id)->first();

        $orig_subtotal = $details->subTotal;
        $subTotal = round($request->price * $request->discount *  $request->quantity, 4);
        $detail = $details->update([
            'product_id' => $request->product_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'discount' => $request->discount,
            'subTotal' => $subTotal,
            'comment' => $request->comment,
        ]);

        if($detail){
            $cart->totalTaxPrice = $cart->totalTaxPrice - $orig_subtotal + $subTotal;
            $cart->save();
            $msg = [
                'messenge' => "更新成功。",
                'status' => 'OK'
            ];

        }else{
            $msg = [
                'messenge' => "更新失敗。",
                'status' => 'Failed'
            ];
        }
        return $msg;
    }

    public function delete($id)
    {
        $detail = CartDetailEloquent::findOrFail($id);
        $cart = CartEloquent::findOrFail($detail->cart_id);
        if($detail){
            $detail->delete();
            $count = 1;
            $total_price = 0;
            $cart_details = CartDetailEloquent::where('cart_id', $detail->cart_id)->get();
            foreach($cart_details as $cart_detail){
                $cart_detail->count = $count;
                $total_price += $cart_detail->subTotal;
                $cart_detail->save();
                $count ++;
            }
            $cart->totalTaxPrice = $total_price;
            $cart->save();
            $msg = [
                'messenge'=>"刪除成功。",
                'status'=>'OK'
            ];
        }else{
            $msg = [
                'messenge'=>"查不到該筆資料。",
                'status'=>'Failed'
            ];
        }
        return $msg;
    }

}
