<?php

namespace App\Services\Orders;

use App\Services\BaseService;
use App\Services\Logs\ProductLogService;
use App\SalesOrderDetail as SalesOrderDetailEloquent;
use App\SalesOrder as SalesOrderEloquent;
use App\Product as ProductEloquent;
use Auth;

class SalesOrderDetailService extends BaseService
{
    // ('paidAmount')->comment('訂單已付額');
    // ('unpaidAmount')->comment('訂單未付額');
    // ('totalPrice')->comment('訂單未稅額');
    // ('taxPrice')->comment('訂單稅額'); // taxType = 1 要加 5%
    // ('totalTaxPrice')->comment('訂單總價');

    public $ProductLogService;

    public function __construct(){
        //act 1.訂單新增 2.訂單修改 3.訂單刪除
        // 13.退貨單細項新增 14.退貨單細項修改 15.退貨單細項刪除
        $this->ProductLogService = new ProductLogService();
    }

    public function add($request){
        $user_id = Auth::id();

        $s_id = $request->salesOrder_id;
        $saleOrder = SalesOrderEloquent::findOrFail($s_id);

        $data = $request->details;
        $total_unTax = 0;
        $count = 0;

        // 判斷是出貨還退貨
        if($saleOrder->status == 1){
            $status = 1;
        }else{
            $status = 13;
        }

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
            $add_price = 0;
            $saleOrder->totalPrice = $total_unTax;
            if($saleOrder->taxType == 1){
                $saleOrder->taxPrice = $total_unTax * 0.05;
                $saleOrder->totalTaxPrice = $total_unTax * 1.05;
                $saleOrder->unpaidAmount = $total_unTax * 1.05;
                $add_price = $total_unTax * 1.05;
            }else{
                $saleOrder->taxPrice = 0;
                $saleOrder->totalTaxPrice = $total_unTax;
                $saleOrder->unpaidAmount = $total_unTax;
                $add_price = $total_unTax;
            }
            $saleOrder->save();
            if($saleOrder->status == 1){
                $saleOrder->consumer->uncheckedAmount += $add_price;
                $saleOrder->consumer->totalConsumption += $add_price;
                $saleOrder->consumer->save();
            }


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
        $details = SalesOrderDetailEloquent::where('saleOrder_id',$s_id)->get();
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
