<?php

namespace App\Services\Orders;

use App\Services\BaseService;
use App\Services\Logs\ProductLogService;
use App\SaleOrderDetail as SaleOrderDetailEloquent;
use App\SaleOrder as SaleOrderEloquent;

use Auth;

     // ('piadAmount')->comment('訂單已付額');
    // ('unpiadAmount')->comment('訂單未付額');
    // ('totalPrice')->comment('訂單未稅額');
    // ('taxPrice')->comment('訂單稅額'); // taxType = 1 要加 5%
    // ('totalTaxPrice')->comment('訂單總價');

class SaleOrderDetailService extends BaseService
{
    public $ProductLogService;

    public function __construct(){
         //act 1.訂單新增 2.訂單修改 3.訂單刪除
        $this->ProductLogService = new ProductLogService();
    }

    public function add($request){
        $user_id = Auth::id();
        $saleOrder = SaleOrderEloquent::findOrFail();

        $s_id = $request->saleOrder_id;
        $data = $request->details;
        $total_unTax = 0;
        $count = 0;

        foreach($data as $obj){
            $count++;

            $product_id = $obj['product_id'];
            $quantity = $obj['quantity'];
            $subTotal = round($obj['price'] * $obj['discount'] * $quantity, 4);
            $total_unTax += $subTotal;
            $this->ProductLogService->add($user_id, $product_id, 1, $quantity);

            $saleOrderDetail = SaleOrderDetailEloquent::create([
                'saleOrder_id' => $s_id,
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
            $add_price = 0;
            $saleOrder->totalPrice = $total_unTax;
            if($saleOrder->taxType == 1){
                $saleOrder->taxPrice = $total_unTax*1.05;
                $saleOrder->totalTaxPrice = $total_unTax*1.05;
                $saleOrder->unpiadAmount = $total_unTax*1.05;
                $add_price=$total_unTax*1.05;
            }else{
                $saleOrder->taxPrice = $total_unTax;
                $saleOrder->totalTaxPrice = $total_unTax;
                $saleOrder->unpiadAmount = $total_unTax;
                $add_price=$total_unTax;
            }
            $saleOrder->save();
            $saleOrder->consumer->uncheckedAmount += $add_price;
            $saleOrder->consumer->totalConsumption += $add_price;
            $saleOrder->consumer->save();

            $msg = [
                'messenge' => "銷貨單編號：$s_id 新增成功，共有 $count 筆原物料儲存成功。",
                'status' => 'OK'
            ];
        }else{
            $msg = [
                'messenge'=> "新增銷貨貨單細項時發生錯誤，無任何細項新增。",
                'status' => 'Failed'
            ];
        }
        return $msg;
    }

    public function getOrderDetails($s_id){
        $details = SaleOrderDetailEloquent::where('saleOrder_id',$s_id)->get();
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





    public function update($request, $s_id, $count){
        $details = SaleOrderDetailEloquent::where('id',$s_id)
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
            $saleOrder = SaleOrderEloquent::findOrFail($s_id);

            if($saleOrder->taxType == 1){
                $subTotal_tax = $subTotal*1.05;
                $orig_subTotal_unTax = $orig_subtotal_tax/1.05;
            }
            $saleOrder->unpiadAmount += $subTotal_tax - $orig_subtotal_tax;
            $saleOrder->totalPrice += $subTotal - $orig_subTotal_unTax;
            $saleOrder->taxPrice += $subTotal_tax - $orig_subtotal_tax;
            $saleOrder->totalTaxPrice += $subTotal_tax - $orig_subtotal_tax;

            $saleOrder->last_user_id = Auth::id();
            $saleOrder->save();

            $saleOrder->consumer->uncheckedAmount += $subTotal_tax - $orig_subtotal_tax;
            $saleOrder->consumer->save();

            $this->ProductLogService->add($user_id, $product_id, 2, $quantity);
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
        $details = SaleOrderDetailEloquent::where('saleOrder_id',$s_id)
            ->where('count',$count)->get();

        if($details){
            $saleOrder = SaleOrderEloquent::find($s_id);
            $saleOrder->last_user_id = Auth::id();
            $saleOrder->save();
            $user_id = Auth::id();
            $product_id = $details->product_id;

            $subTotal = $details->subTotal;
            if($saleOrder->taxType == 1){
                $subTotal_tax = $subTotal*1.05;
            }
            $saleOrder->unpiadAmount -= $subTotal_tax;
            $saleOrder->totalPrice -= $subTotal;
            $saleOrder->taxPrice -= $subTotal_tax;
            $saleOrder->totalTaxPrice -= $subTotal_tax;

            $saleOrder->last_user_id = Auth::id();
            $saleOrder->save();

            $saleOrder->consumer->uncheckedAmount -= $subTotal_tax;
            $saleOrder->consumer->totalConsumption -= $subTotal_tax;
            $saleOrder->consumer->save();
            $this->ProductLogService->add($user_id, $product_id, 3, 0);
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
