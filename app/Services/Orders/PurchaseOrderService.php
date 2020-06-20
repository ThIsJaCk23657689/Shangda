<?php

namespace App\Services\Orders;
use App\Services\BaseService;
use App\PurchaseOrder as PurchaseOrderEloquent;
use App\MaterialLog as MaterialLogEloquent;
use App\Material as MaterialEloquent;

use Carbon\Carbon;
use Auth;

class PurchaseOrderService extends BaseService
{
    public function add($request)
    {
        $today = Carbon::today()->toDateTimeString();   //2019-12-26 00:00:00
        $today = substr($today, 0, 10);                 //2019-12-26
        $today = str_replace('-', '', $today);            //20191226
        $count = PurchaseOrderEloquent::where('shown_id', 'like', 'P' . $today . '%')->count();
        $count += 1;
        $count = str_pad($count, 4, '0', STR_PAD_LEFT);
        $shown_id = 'P'.$today.$count;                  //P201912260001

        if($request->totalPrice == NULL){
            $request->totalPrice = 0;
        }


        $purchaseOrder = PurchaseOrderEloquent::create([
            'supplier_id' => $request->supplier_id,
            'user_id' => Auth::id(),
            'last_user_id' => Auth::id(),
            'paid_at' => $request->paid_at,
            'received_at' => $request->received_at,
            'expectReceived_at' => $request->expectReceived_at,
            'totalPrice' => $request->totalPrice,
            'comment' => $request->comment,
            'taxType' => $request->taxType,
            'invoiceType' => $request->invoiceType,
            'address' => $request->address,
            'shown_id' => $shown_id,
        ]);
        return $purchaseOrder;
    }

    public function getList()
    {
        $purchaseOrders = PurchaseOrderEloquent::get();
        return $purchaseOrders;
    }

    public function getOne($id)
    {
        $purchaseOrder = PurchaseOrderEloquent::findOrFail($id);
        return $purchaseOrder;
    }

    public function update($request, $id)
    {
        $purchaseOrder = $this->getOne($id);
        $purchaseOrder->update([
            'supplier_id' => $request->supplier_id,
            'last_user_id' => Auth::id(),
            'paid_at' => $request->paid_at,
            'received_at' => $request->received_at,
            'expectReceived_at' => $request->expectReceived_at,
            'totalPrice' => $request->totalPrice,
            'comment' => $request->comment,
            'taxType' => $request->taxType,
            'invoiceType' => $request->invoiceType,
            'address' => $request->address,
        ]);
        return $purchaseOrder;
    }

    public function delete($id)
    {
        $purchaseOrder = $this->getOne($id);
        $purchaseOrder->delete();
    }

    public function getlastupdate()
    {
        $purchaseOrder = PurchaseOrderEloquent::orderBy('id', 'DESC')->first();
        if(!empty($purchaseOrder)){
            return $purchaseOrder->updated_at;
        }
        return null;
    }

    public function received($request){
        $purchase_order_id = $request->purchase_id;

        $purchaseOrder = $this->getOne($purchase_order_id);
        if($purchaseOrder and $purchaseOrder->received_at == NULL){
            // 確認到貨
            $received_at = $request->received_at;
            $purchaseOrder->received_at = $received_at;
            $purchaseOrder->last_user_id = Auth::id();
            $purchaseOrder->save();

            $purchaseOrder_details = $purchaseOrder->details();
            if($purchaseOrder_details){
                foreach($purchaseOrder_details as $detail){
                    // 加入庫存量
                    $material = MaterialEloquent::findOrFail($detail->material_id);
                    $material->stock = $material->stock + $detail->quantity;
                    $material->save();

                    // 寫入log
                    MaterialLogEloquent::create([
                        'user_id' => Auth::id(),
                        'material_id' => $detail->material_id,
                        'act' => 7,
                        'amount' => $detail->quantity,
                    ]);
                }

                return [
                    'message' => '成功到貨！',
                    'status' => 200
                ];
            }else{
                return [
                    'message' => '進貨單內無任何原物料！',
                    'status' => 422
                ];
            }
        }else if($purchaseOrder and $purchaseOrder->received_at != NULL){
            // 重複按 => 取消到貨
            $purchaseOrder->received_at = NULL;
            $purchaseOrder->last_user_id = Auth::id();
            $purchaseOrder->save();
            $purchaseOrder_details = $purchaseOrder->details();
            if($purchaseOrder_details){

                foreach($purchaseOrder_details as $detail){
                    $material = MaterialEloquent::findOrFail($detail->material_id);
                    $material->stock = $material->stock - $detail->quantity;
                    $material->save();
                    MaterialLogEloquent::create([
                        'user_id' => Auth::id(),
                        'material_id' => $detail->material_id,
                        'act' => 8,
                        'amount' => -$detail->quantity,
                    ]);
                }

                return [
                    'message' => '成功取消到貨！',
                    'status' => 200
                ];
            }else{
                return [
                    'message' => '進貨單內無任何原物料！',
                    'status' => 422
                ];
            }

        }else{
            return  [
                'message' => '查無此進貨單',
                'status' => 404
            ];
        }
    }

    public function paid($request){
        $purchase_order_id = $request->purchase_id;
        $paid_at = $request->paid_at;
        $purchaseOrder = $this->getOne($purchase_order_id);

        if($purchaseOrder and $purchaseOrder->paid_at == NULL){
            // 確認付款
            $purchaseOrder->paid_at = $paid_at;
            $purchaseOrder->last_user_id = Auth::id();
            $purchaseOrder->save();

            $purchaseOrder_details = $purchaseOrder->details();
            if($purchaseOrder_details){
                foreach($purchaseOrder_details as $detail){
                    MaterialLogEloquent::create([
                        'user_id' => Auth::id(),
                        'material_id' => $detail->material_id,
                        'act' => 9,
                        'amount' => 0,
                    ]);
                }
                return  [
                    'message' => '成功付清！',
                    'status' => 200
                ];
            }else{
                return  [
                    'message' => '進貨單內無任何原物料！',
                    'status' => 422
                ];
            }
        }else if($purchaseOrder and $purchaseOrder->paid_at != NULL){
            // 重複按 => 取消付款
            $purchaseOrder->paid_at = NULL;
            $purchaseOrder->last_user_id = Auth::id();
            $purchaseOrder->save();
            $purchaseOrder_details = $purchaseOrder->details();
            if($purchaseOrder_details){
                foreach($purchaseOrder_details as $detail){
                    MaterialLogEloquent::create([
                        'user_id' => Auth::id(),
                        'material_id' => $detail->material_id,
                        'act' => 10,
                        'amount' => 0,
                    ]);
                }
                return  [
                    'message' => '成功取消付清！',
                    'status' => 200
                ];
            }else{
                return  [
                    'message' => '進貨單內無任何原物料！',
                    'status' => 422
                ];
            }

        }else{
            return  [
                'message' => '查無此進貨單',
                'status' => 404
            ];
        }

    }
}
