<?php

namespace App\Services\Orders;
use App\Services\BaseService;
use App\SaleOrder as SaleOrderEloquent;
use App\Product as ProductEloquent;
use App\Services\NotificationService;
use App\Services\Logs\ProductLogService;
use Auth;

class SaleOrderService extends BaseService
{
    public $NotificationService;
    public $ProductLogService;

    public function __construct()
    {
        //7.確認出貨 8.取消出貨 9.確認付款 10.取消付款
        $this->ProductLogService = new ProductLogService();
        $this->NotificationService = new NotificationService();
    }

    public function add($request)
    {
        $saleOrder = SaleOrderEloquent::create([
            'consumers_id' => $request->consumers_id,
            'user_id' => $request->user_id,
            'last_user_id' => $request->user_id,
            'expectPay_at' => $request->expectPay_at,
            'paid_at' => $request->paid_at,
            'expectDeliver_at' => $request->expectDeliver_at,
            'delivered_at' => $request->delivered_at,
            'makeInvoice_at' => $request->makeInvoice_at,

            'piadAmount' => $request->piadAmount,
            'unpiadAmount' => $request->unpiadAmount,
            'totalPrice' => $request->totalPrice,
            'taxPrice' => $request->taxPrice,
            'totalTaxPrice' => $request->totalTaxPrice,

            'comment' => $request->comment,
            'taxType' => $request->taxType,
            'invoiceType' => $request->invoiceType,
            'address' => $request->address,
        ]);

        // 發送通知
        $this->NotificationService->addSaleOrderNotice($saleOrder->id);

        return $saleOrder;
    }

    public function getList()
    {
        $saleOrders = SaleOrderEloquent::get();
        return $saleOrders;
    }

    public function getOne($id)
    {
        $saleOrder = SaleOrderEloquent::find($id);
        return $saleOrder;
    }

    public function update($request, $id)
    {
        $saleOrder = $this->getOne($id);
        $saleOrder->update([
            'consumers_id' => $request->consumers_id,
            'last_user_id' => Auth::id(),

            'expectPay_at' => $request->expectPay_at,
            'paid_at' => $request->paid_at,
            'expectDeliver_at' => $request->expectDeliver_at,
            'delivered_at' => $request->delivered_at,
            'makeInvoice_at' => $request->makeInvoice_at,

            'piadAmount' => $request->piadAmount,
            'unpiadAmount' => $request->unpiadAmount,
            'totalPrice' => $request->totalPrice,
            'taxPrice' => $request->taxPrice,
            'totalTaxPrice' => $request->totalTaxPrice,

            'comment' => $request->comment,
            'taxType' => $request->taxType,
            'invoiceType' => $request->invoiceType,
            'address' => $request->address,
        ]);
        return $saleOrder;
    }

    public function delete($id)
    {
        $saleOrder = $this->getOne($id);
        $saleOrder->delete();
    }

    public function getlastupdate()
    {
        $saleOrder = SaleOrderEloquent::orderBy('id', 'DESC')->first();
        if(!empty($saleOrder)){
            return $saleOrder->updated_at;
        }

        return null;
    }

    public function delivered($request){
        $saleOrder_id = $request->id;
        $delivered_at = $request->delivered_at;

        $saleOrder = $this->getOne($saleOrder_id);
        if($saleOrder and $saleOrder->delivered_at == NULL){
            // 確認出貨
            $saleOrder->delivered_at = $delivered_at;
            $saleOrder->last_user_id = Auth::id();
            $saleOrder->save();
            $saleOrder_details = $saleOrder->details();
            if($saleOrder_details){
                foreach($saleOrder_details as $detail){
                    $product = ProductEloquent::findOrFail($detail->product_id);
                    $product->quantity = $product->quantity - $detail->quantity;
                    $product->save();
                    // 若低於安全庫存量發通知
                    if($product->quantity<$product->safeQuantity){
                        $this->NotificationService->productUnderSafe($product->id);
                    }
                    $this->ProductLogService->add(Auth::id(), $detail->product_id, 7, $detail->quantity);
                }
                return "Delivered Success";
            }else{
                return 'Details Not Found';
            }
        }else if($saleOrder and $saleOrder->delivered_at != NULL){
            // 重複按 => 取消出貨
            $saleOrder->delivered_at = NULL;
            $saleOrder->last_user_id = Auth::id();
            $saleOrder->save();
            $saleOrder_details = $saleOrder->details();
            if($saleOrder_details){

                foreach($saleOrder_details as $detail){
                    $product = ProductEloquent::findOrFail($detail->product_id);
                    $product->quantity = $product->quantity + $detail->quantity;
                    $product->save();
                    $this->ProductLogService->add(Auth::id(), $detail->product_id, 8, $detail->quantity);
                }
                return "Delivered Canceled";
            }else{
                return 'Details Not Found';
            }

        }else{
            return 'Sale Order Not Found';
        }
    }

    public function paid($request){
        $saleOrder_id = $request->id;
        $paid_at = $request->paid_at;
        $saleOrder = $this->getOne($saleOrder_id);

        if($saleOrder and $saleOrder->received_at == NULL){
            // 確認付款
            $saleOrder->received_at = $paid_at;
            $saleOrder->last_user_id = Auth::id();
            $saleOrder->save();
            $saleOrder_details = $saleOrder->details();
            if($saleOrder_details){
                foreach($saleOrder_details as $detail){
                    $this->ProductLogService->add(Auth::id(), $detail->product_id, 9, 0);
                }
                return "Payment Confirmed";
            }else{
                return 'Details Not Found';
            }
        }else if($saleOrder and $saleOrder->paid_at != NULL){
            // 重複按 => 取消付款
            $saleOrder->paid_at = NULL;
            $saleOrder->last_user_id = Auth::id();
            $saleOrder->save();
            $saleOrder_details = $saleOrder->details();
            if($saleOrder_details){
                foreach($saleOrder_details as $detail){
                    $this->ProductLogService->add(Auth::id(), $detail->product_id, 10, 0);
                }
                return "Payment Canceled";
            }else{
                return 'Details Not Found';
            }

        }else{
            return 'Sale Order Not Found';
        }

    }


}
