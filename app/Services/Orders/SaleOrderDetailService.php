<?php

namespace App\Services\Orders;

use App\Services\BaseService;
use App\Services\Logs\ProductLogService;
use App\SaleOrderDetail as SaleOrderDetailEloquent;
use App\SaleOrder as SaleOrderEloquent;
use Auth;

class SaleOrderDetailService extends BaseService
{
    public $ProductLogService;

    public function __construct(){
         //act 1.訂單新增 2.訂單修改 3.訂單刪除
        $this->ProductLogService = new ProductLogService();
    }

    public function add($request){
        $user_id = Auth::id();

        $s_id = $request->saleOrder_id;
        $data = $request->details;
        $count = 0;

        foreach($data as $obj){
            $count++;

            $product_id = $obj['product_id'];
            $quantity = $obj['quantity'];
            $subTotal = round($obj['price'] * $obj['discount'] * $quantity, 4);
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
        $details = SaleOrderDetailEloquent::where('saleOrder_id',$s_id)
            ->where('count',$count)->get();

        $orig_quantity = $details->quantity;
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
            $saleOrder = SaleOrderEloquent::find($s_id);
            $saleOrder->last_user_id = Auth::id();
            $saleOrder->save();
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
