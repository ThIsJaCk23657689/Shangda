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
        $token = JWTAuth::getToken();
        $consumer = JWTAuth::toUser($token);

        $cart_id = $request->cart_id;
        $cart = CartEloquent::findOrFail($cart_id);

        $data = $request->details;
        $total_unTax = 0;
        $count = 0;


        foreach($data as $obj){
            $count++;

            $product_id = $obj['product_id'];
            $quantity = $obj['quantity'];
            $subTotal = round($obj['price'] * $obj['discount'] * $quantity, 4);
            $total_unTax += $subTotal;
            $this->ProductLogService->add($user_id, $product_id, $status, $quantity);

            $saleOrderDetail = SalesOrderDetailEloquent::create([
                'sales_order_id' => $s_id,
                'count' => $count,
                'product_id' => $obj['product_id'],
                'price' => $obj['price'],
                'quantity' => $quantity,
                'discount' => $obj['discount'],
                'subTotal' => $subTotal,
                'comment' => $obj['comment'],
            ]);

        }
        if($saleOrderDetail){


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



    public function update($request, $s_id, $count){
        $details = SalesOrderDetailEloquent::where('id',$s_id)
            ->where('count',$count)->get();

        $orig_quantity = $details->quantity;
        $orig_subtotal_tax = $details->subTotal;
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
            $user_id = Auth::id();
            $product_id = $request->product_id;
            $quantity = $orig_quantity - $request->quantity;
            $saleOrder = SalesOrderEloquent::findOrFail($s_id);

            if($saleOrder->taxType == 1){
                $subTotal_tax = $subTotal*1.05;
                $orig_subTotal_unTax = $orig_subtotal_tax/1.05;
            }
            $saleOrder->unpaidAmount += $subTotal_tax - $orig_subtotal_tax;
            $saleOrder->totalPrice += $subTotal - $orig_subTotal_unTax;
            $saleOrder->taxPrice += $subTotal_tax - $orig_subtotal_tax;
            $saleOrder->totalTaxPrice += $subTotal_tax - $orig_subtotal_tax;

            $saleOrder->last_user_id = Auth::id();
            $saleOrder->save();

            // 判斷是出貨還退貨
            if($saleOrder->status == 1){
                $status = 2;
                $saleOrder->consumer->uncheckedAmount += $subTotal_tax - $orig_subtotal_tax;
                $saleOrder->consumer->save();
            }else{
                $status = 14;
            }


            $this->ProductLogService->add($user_id, $product_id, $status, $quantity);
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

    public function delete($s_id, $count)
    {
        $details = SalesOrderDetailEloquent::where('saleOrder_id',$s_id)
            ->where('count',$count)->get();

        if($details){
            $saleOrder = SalesOrderEloquent::find($s_id);
            $saleOrder->last_user_id = Auth::id();
            $saleOrder->save();
            $user_id = Auth::id();
            $product_id = $details->product_id;

            $subTotal = $details->subTotal;
            if($saleOrder->taxType == 1){
                $subTotal_tax = $subTotal*1.05;
            }
            $saleOrder->unpaidAmount -= $subTotal_tax;
            $saleOrder->totalPrice -= $subTotal;
            $saleOrder->taxPrice -= $subTotal_tax;
            $saleOrder->totalTaxPrice -= $subTotal_tax;

            $saleOrder->last_user_id = Auth::id();
            $saleOrder->save();


            // 判斷是出貨還退貨
            if($saleOrder->status == 1){
                $status = 3;
                $saleOrder->consumer->uncheckedAmount -= $subTotal_tax;
                $saleOrder->consumer->totalConsumption -= $subTotal_tax;
                $saleOrder->consumer->save();
            }else{
                $status = 15;
            }

            $this->ProductLogService->add($user_id, $product_id, $status, 0);
            $details->delete();
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