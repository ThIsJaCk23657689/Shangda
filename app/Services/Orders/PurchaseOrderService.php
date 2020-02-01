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
        $today = str_replace('-','',$today);            //20191226
        $count = PurchaseOrderEloquent::where('shown_id','like','P'.$today.'%')->count();
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

        // if($purchaseOrder->taxType == 1){
        //     $beforePrice = $purchaseOrder->totalPrice*0.95;
        //     $tax = $purchaseOrder->totalPrice*0.05;
        // }elseif($purchaseOrder->taxType == 2 or $purchaseOrder->taxType == 3){
        //     $beforePrice = $purchaseOrder->totalPrice;
        //     $tax = 0;
        // }

        // if($purchaseOrder){
        //     $msg = [
        //         'data'=>$purchaseOrder,
        //         'beforePrice'=>$beforePrice,
        //         'tax'=>$tax,
        //         'status'=>'OK'
        //     ];
        // }else{
        //     $msg = [
        //         'data'=>$purchaseOrder,
        //         'status'=>'No data exist.'
        //     ];
        // }
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
        $purchase_order_id = $request->id;
        $received_at = $request->received_at;

        $purchaseOrder = $this->getOne($purchase_order_id);
        if($purchaseOrder){
            $purchaseOrder->received_at = $received_at;
            $purchaseOrder->last_user_id = Auth::id();
            $purchaseOrder->save();
            $purchaseOrder_details = $purchaseOrder->details();
            if($purchaseOrder_details){
                foreach($purchaseOrder_details as $detail){
                    $material = MaterialEloquent::findOrFail($detail->material_id);
                    $material->stock = $material->stock + $detail->quantity;
                    $material->save();
                    MaterialLogEloquent::create([
                        'user_id' => Auth::id(),
                        'material_id' => $detail->material_id,
                        'act' => 1,
                        'amount' => $detail->quantity,
                    ]);
                }
                return "Success";
            }else{
                return 'Details Not Found';
            }
        }else{
            return 'Purchase Order Not Found';
        }

    }
}
