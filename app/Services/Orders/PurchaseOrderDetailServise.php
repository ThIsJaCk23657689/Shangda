<?php

namespace App\Services\Orders;
use App\Services\BaseService;
use App\Services\Orders\PurchaseOrderService;
use App\PurchaseOrder as PurchaseOrderEloquent;
use App\PurchaseOrderDetail as PurchaseOrderDetailEloquent;

use Carbon\Carbon;

class PurchaseOrderDetailService extends BaseService
{
    public function add($request)
    {
        $p_id = $request->purchaseOrder_id;
        $data = $request->details;
        $count = 0;
        foreach($data as $obj){
            $count += 1;
            $subTotal = round($obj['price'] * $obj['discount'] * $obj['quantity'], 4);
            $purchaseOrderDetail = PurchaseOrderDetailEloquent::create([
                'purchaseOrder_id' => $p_id,
                'count' => $count,

                'material_id' => $obj['material_id'],
                'price' => $obj['price'],
                'quantity' => $obj['quantity'],
                'discount' => $obj['discount'],
                'subTotal' => $subTotal,
                'comment' => $obj['comment'],
            ]);
        }
        if($purchaseOrderDetail){
            $msg = [
                'massenge'=>"總共有".$count."筆資料新增成功。",
                'status'=>'OK'
            ];
        }else{
            $msg = [
                'massenge'=>"無資料新增。",
                'status'=>'Failed'
            ];
        }
        return $msg;
    }

    public function getOrderDetails($p_id){
        $details = PurchaseOrderDetailEloquent::where('purchaseOrder_id',$p_id)->get();
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

    public function update($request, $p_id, $count)
    {
        $details = PurchaseOrderDetailEloquent::where('purchaseOrder_id',$p_id)
                                            ->where('count',$count)->get();

        $detail = $details->update([
            'material_id' => $request->material_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'discount' => $request->discount,
            'subTotal' => $request->subTotal,
            'comment' => $request->comment,
        ]);
        if($detail){
            $msg = [
                'massenge'=>"更新成功。",
                'status'=>'OK'
            ];
        }else{
            $msg = [
                'massenge'=>"更新失敗。",
                'status'=>'Failed'
            ];
        }
        return $msg;
    }

    public function delete($p_id, $count)
    {
        $details = PurchaseOrderDetailEloquent::where('purchaseOrder_id',$p_id)
                                            ->where('count',$count)->get();
        if($details){
            $details->delete();
            $msg = [
                'massenge'=>"刪除成功。",
                'status'=>'OK'
            ];
        }else{
            $msg = [
                'massenge'=>"查不到該筆資料。",
                'status'=>'Failed'
            ];
        }
        return $msg;
    }

    public function getlastupdate()
    {
        $saleOrder = SaleOrderEloquent::orderBy('id', 'DESC')->first();
        if(!empty($saleOrder)){
            return $saleOrder->updated_at;
        }

        return null;
    }
}