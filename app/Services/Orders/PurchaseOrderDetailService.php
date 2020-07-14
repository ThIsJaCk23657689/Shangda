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

        $pid = $request->purchaseOrder_id;
        $purchaseOrder = PurchaseOrderEloquent::find($pid);
        $details = $request->details;

        // 將原物料加入至進貨單details
        $result = $this->addDetails($pid, $details);

        if($result){
            $msg = [
                'message' => '進貨單編號：' . $purchaseOrder->shown_id . '已新增成功！',
                'url' => route('purchase.index'),
                'status' => 200
            ];
        }else{
            $msg = [
                'message'=> '新增進貨單細項時發生錯誤，請稍後再試。',
                'status' => 422
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

    public function update($request){
        $pid = $request->purchaseOrder_id;
        $purchaseOrder = PurchaseOrderEloquent::find($pid);
        $old_details = $purchaseOrder->details;
        $new_details = $request->details;
        
        // 先將所有原物料從細項中刪除。
        $result = $this->removeDetails($pid, $old_details, true);
        if(!$result){
            // 刪除失敗
            return [
                'message'=> '更新進貨單細項時發生錯誤，請稍後再試。',
                'status' => 422
            ];
        }

        // 再新增修改過後的原物料到細項當中。
        $result = $this->addDetails($pid, $new_details, true);
        if(!$result){
            // 新增失敗
            return [
                'message'=> '更新進貨單細項時發生錯誤，請稍後再試。',
                'status' => 422
            ];
        }

        $userID = Auth::id();
        // for($i = 1; $i <= count($new_details); $i++){
        //     if($new_details[$i]['material_id'] == $old_details[$i]['material_id']){
        //         $delta_qty = $new_details[$i]['quantity'] - $old_details[$i]['quantity'];
        //         $this->MaterialLogService->add($userID, $new_details[$i]['material_id'], 2, $delta_qty);
        //     }else{                
        //         $this->MaterialLogService->add($userID, $old_details[$i]['material_id'], 3, $old_details[$i]['quantity']);
        //         $this->MaterialLogService->add($userID, $new_details[$i]['material_id'], 1, $new_details[$i]['quantity']);
        //     }
        // }

        $purchaseOrder->last_user_id = $userID;
        $purchaseOrder->save();

        return [
            'message' => '進貨單編號：' . $purchaseOrder->shown_id . '已更新成功！',
            'status' => 200
        ];
    }

    public function delete($pid)
    {
        $purchaseOrder = PurchaseOrderEloquent::find($pid);
        $details = $purchaseOrder->details;
        
        // 先將所有原物料從細項中刪除。
        $result = $this->removeDetails($pid, $details, true);
        if(!$result){
            // 刪除失敗
            return false;
        }

        return true;
    }

    public function getlastupdate(){
        $saleOrder = PurchaseOrderDetailEloquent::orderBy('id', 'DESC')->first();
        if(!empty($saleOrder)){
            return $saleOrder->updated_at;
        }
        return null;
    }

    private function addDetails($pid, $details, $logging = true){
        $userID = Auth::id();
        $count = 0;
        foreach($details as $detail){
            $count++;
            $subTotal = round($detail['price'] * $detail['discount'] * $detail['quantity'], 4);
            if($logging){
                $this->MaterialLogService->add($userID, $detail['material_id'], 1, $detail['quantity']);
            }

            PurchaseOrderDetailEloquent::create([
                'purchaseOrder_id' => $pid,
                'count' => $count,
                'material_id' => $detail['material_id'],
                'price' => $detail['price'],
                'quantity' => $detail['quantity'],
                'discount' => $detail['discount'],
                'subTotal' => $subTotal,
                'comment' => $detail['comment'],
            ]);
        }

        if($count == count($details)){
            return true;
        }else{
            return false;
        }
    }

    private function removeDetails($pid, $details){
        $userID = Auth::id();
        $count = 0;
        foreach($details as $detail){
            $count++;
            $this->MaterialLogService->add($userID, $detail['material_id'], 3, $detail['quantity']);
            $detail->delete();
        }

        if($count == count($details)){
            return true;
        }else{
            return false;
        }
    }
}
