<?php

namespace App\Services\Orders;

use App\Services\BaseService;
use App\Services\Logs\MaterialLogService;
use App\PurchaseOrderDetail as PurchaseOrderDetailEloquent;
use App\PurchaseOrder as PurchaseOrderEloquent;
use Auth;

class PurchaseOrderDetailService extends BaseService
{
    public $MaterialLogService;

    public function __construct(){
        $this->MaterialLogService = new MaterialLogService();
    }

    public function add($request){
        $user_id = Auth::id();
        
        $p_id = $request->purchaseOrder_id;
        $data = $request->details;
        $count = 0;
        
        foreach($data as $obj){
            $count++;

            $material_id = $obj['material_id'];
            $quantity = $obj['quantity'];
            $subTotal = round($obj['price'] * $obj['discount'] * $obj['quantity'], 4);
            $this->MaterialLogService->add($user_id, $material_id, 1, $quantity);
            
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
                'messenge' => "進貨單編號：$p_id 新增成功，共有 $count 筆原物料儲存成功。",
                'status' => 'OK'
            ];
        }else{
            // 這邊是沒有任何進貨單細項新增成功，可能也要連帶把之前新增好的進貨單刪除。
            $msg = [
                'messenge'=> "新增進貨單細項時發生錯誤，無任何細項新增。",
                'status' => 'Failed'
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

    public function update($request, $p_id, $count){
        $details = PurchaseOrderDetailEloquent::where('purchaseOrder_id',$p_id)
            ->where('count',$count)->get();

        $orig_quantity = $details->quantity;
        $detail = $details->update([
            'material_id' => $request->material_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'discount' => $request->discount,
            'subTotal' => $request->subTotal,
            'comment' => $request->comment,
        ]);

        if($detail){
            $user_id = Auth::id();
            $material_id = $request->material_id;
            $quantity = $orig_quantity - $request->quantity;
            $this->MaterialLogService->add($user_id, $material_id, 2, $quantity);
            $purchaseOrder = PurchaseOrderEloquent::find($p_id);
            $purchaseOrder->last_user_id = Auth::id();
            $purchaseOrder->save();
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

    public function delete($p_id, $count)
    {
        $details = PurchaseOrderDetailEloquent::where('purchaseOrder_id',$p_id)
            ->where('count',$count)->get();
        
        if($details){
            $purchaseOrder = PurchaseOrderEloquent::find($p_id);
            $purchaseOrder->last_user_id = Auth::id();
            $purchaseOrder->save();
            $user_id = Auth::id();
            $material_id = $details->material_id;
            $this->MaterialLogService->add($user_id, $material_id, 3, 0);

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

    public function getlastupdate()
    {
        $saleOrder = SaleOrderEloquent::orderBy('id', 'DESC')->first();
        if(!empty($saleOrder)){
            return $saleOrder->updated_at;
        }

        return null;
    }
}