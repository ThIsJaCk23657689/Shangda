<?php

namespace App\Services\Orders;
use App\Services\BaseService;
use App\SalesOrder as SalesOrderEloquent;
use App\Product as ProductEloquent;
use App\Services\NotificationService;
use App\Services\Logs\ProductLogService;
use Auth;
use Carbon\Carbon;

class SalesOrderService extends BaseService
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
        $shownID = $this->generateShownID();
        $saleOrder = SalesOrderEloquent::create([
            'consumer_id' => $request->consumer_id,
            'shown_id' => $shownID,

            'user_id' => Auth::id(),
            'last_user_id' => Auth::id(),
            'expectPay_at' => $request->expectPay_at,
            // 'paid_at' => $request->paid_at,
            'expectDeliver_at' => $request->expectDeliver_at,
            // 'delivered_at' => $request->delivered_at,
            'makeInvoice_at' => $request->makeInvoice_at,

            // 'paidAmount' => $request->paidAmount,
            // 'unpaidAmount' => $request->unpaidAmount,
            // 'totalPrice' => $request->totalPrice,
            // 'taxPrice' => $request->taxPrice,
            // 'totalTaxPrice' => $request->totalTaxPrice,

            'comment' => $request->comment,
            'taxType' => $request->taxType,
            'status' => $request->status,
            'invoiceType' => $request->invoiceType,
            'address' => $request->address,
            'confirmStatus' => $request->confirmStatus,
            'who_created' => $request->who_created,
        ]);

        // 發送通知
        $this->NotificationService->addSaleOrderNotice($saleOrder->id);

        return $saleOrder;
    }

    public function getList()
    {
        $saleOrders = SalesOrderEloquent::where('status', 1)->where('confirmStatus', 1)->get();
        return $saleOrders;
    }

    public function getUnconfirmedList()
    {
        $saleOrders = SalesOrderEloquent::where('status', 1)->where('confirmStatus', 0)->get();
        return $saleOrders;
    }

    public function getRejectedList()
    {
        $saleOrders = SalesOrderEloquent::where('status', 1)->where('confirmStatus', 2)->get();
        return $saleOrders;
    }

    public function getOne($id)
    {
        $saleOrder = SalesOrderEloquent::find($id);
        return $saleOrder;
    }

    public function confirmOrder($id,$status){

        $saleOrder = $this->getOne($id);
        $orginalStatus = $saleOrder->confirmStatus;
        $saleOrder->confirmStatus = $status;
        $saleOrder->save();
        if ($status == 1 and ($orginalStatus == 0 or $orginalStatus == 2)){
            //沒訂單或尚未確認變成有訂單，應新增金額。
            $totalTaxPrice = $saleOrder->totalTaxPrice;
            $saleOrder->consumer->uncheckedAmount += $totalTaxPrice;
            $saleOrder->consumer->totalConsumption += $totalTaxPrice;
            $saleOrder->consumer->save();
            return $saleOrder;
        }elseif($status == 2 and $orginalStatus == 1){
            //已確認訂單刪除，應刪除金額。
            $totalTaxPrice = $saleOrder->totalTaxPrice;
            $saleOrder->consumer->uncheckedAmount -= $totalTaxPrice;
            $saleOrder->consumer->totalConsumption -= $totalTaxPrice;
            $saleOrder->consumer->save();
            return $saleOrder;
        }
        return "error";
    }

    public function update($request, $id)
    {
        $saleOrder = $this->getOne($id);
        if($request->taxType == $saleOrder->taxType){
            $saleOrder->update([
                'consumers_id' => $request->consumers_id,
                'last_user_id' => Auth::id(),

                'expectPay_at' => $request->expectPay_at,
                'paid_at' => $request->paid_at,
                'expectDeliver_at' => $request->expectDeliver_at,
                'delivered_at' => $request->delivered_at,
                'makeInvoice_at' => $request->makeInvoice_at,

                'comment' => $request->comment,
                'taxType' => $request->taxType,
                'status' => $request->status,
                'invoiceType' => $request->invoiceType,
                'address' => $request->address,
            ]);
        }else if($saleOrder->taxType != 1 && $request->taxType != 1){
            $saleOrder->update([
                'consumers_id' => $request->consumers_id,
                'last_user_id' => Auth::id(),

                'expectPay_at' => $request->expectPay_at,
                'paid_at' => $request->paid_at,
                'expectDeliver_at' => $request->expectDeliver_at,
                'delivered_at' => $request->delivered_at,
                'makeInvoice_at' => $request->makeInvoice_at,

                'comment' => $request->comment,
                'taxType' => $request->taxType,
                'status' => $request->status,
                'invoiceType' => $request->invoiceType,
                'address' => $request->address,
            ]);
        }else if($saleOrder->taxType != 1 && $request->taxType == 1){
            $saleOrder->update([
                'consumers_id' => $request->consumers_id,
                'last_user_id' => Auth::id(),

                'expectPay_at' => $request->expectPay_at,
                'paid_at' => $request->paid_at,
                'expectDeliver_at' => $request->expectDeliver_at,
                'delivered_at' => $request->delivered_at,
                'makeInvoice_at' => $request->makeInvoice_at,

                // 'paidAmount' => $request->paidAmount,
                // 'unpaidAmount' => $request->unpaidAmount,
                // 'totalPrice' => $request->totalPrice,
                'taxPrice' => $request->taxPrice*1.05,
                'totalTaxPrice' => $request->totalTaxPrice*1.05,

                'comment' => $request->comment,
                'taxType' => $request->taxType,
                'status' => $request->status,
                'invoiceType' => $request->invoiceType,
                'address' => $request->address,
            ]);
            $saleOrder->consumer->uncheckedAmount =  $saleOrder->consumer->uncheckedAmount - $request->taxPrice + $request->taxPrice*1.05;
            $saleOrder->consumer->save();
        }

        return $saleOrder;
    }

    public function delete($id)
    {
        $saleOrder = $this->getOne($id);
        $saleOrder->consumer->uncheckedAmount -= $saleOrder->totalTaxPrice;
        $saleOrder->consumer->save();
        $saleOrder->details()->delete();
        $saleOrder->delete();
    }

    public function getlastupdate()
    {
        $saleOrder = SalesOrderEloquent::where('status', 1)->orderBy('id', 'DESC')->first();
        if(!empty($saleOrder)){
            return $saleOrder->updated_at;
        }

        return null;
    }

    public function delivered($request){
        $saleOrder_id = $request->sales_id;
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
                return [
                    'message' => '成功出貨！',
                    'status' => 200
                ];
            }else{
                return [
                    'message' => '銷貨單內無任何原物料！',
                    'status' => 422
                ];
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
                return [
                    'message' => '成功取消出貨！',
                    'status' => 200
                ];
            }else{
                return [
                    'message' => '銷貨單內無任何原物料！',
                    'status' => 422
                ];
            }

        }else{
            return  [
                'message' => '查無此銷貨單',
                'status' => 404
            ];
        }
    }

    // SaleOrder 以下註解是方便查看用
    // ('paidAmount')->comment('訂單已付額');
    // ('unpaidAmount')->comment('訂單未付額');
    // ('totalPrice')->comment('訂單未稅額');
    // ('taxPrice')->comment('訂單稅額'); // taxType = 1 要加 5%
    // ('totalTaxPrice')->comment('訂單總價');
    // uncheckedAmount -> consumer 未沖帳金額
    public function paid($request){
        $saleOrder_id = $request->sales_id;
        $paid_at = $request->paid_at;
        // 此次付款金額 可超付或少付
        $paidAmount = $request->paidAmount;
        $saleOrder = $this->getOne($saleOrder_id);

        if($saleOrder and $saleOrder->paid_at == NULL){
            // 確認付款 unpaidAmount paidAmount
            $saleOrder->paid_at = $paid_at;
            $orig_unpaidAmount = $saleOrder->unpaidAmount;

            //  付清或少付
            if($paidAmount <= $orig_unpaidAmount){
                $saleOrder->paidAmount += $paidAmount;
                $saleOrder->unpaidAmount -= $paidAmount;

            }else{ // 超付
                $saleOrder->overpaidAmount = $paidAmount - $orig_unpaidAmount;
                $saleOrder->unpaidAmount = 0;
                $saleOrder->paidAmount = $saleOrder->totalTaxPrice;
            }
            // 扣除客戶未結款項
            $saleOrder->consumer->uncheckedAmount -= $paidAmount;
            $saleOrder->consumer->save();
            $saleOrder->last_user_id = Auth::id();
            $saleOrder->save();
            return  [
                'message' => '成功付清',
                'status' => 200
            ];
        }else{
            return  [
                'message' => '查無此銷貨單',
                'status' => 404
            ];
        }

    }

    public function paymentCancel($request){
        $saleOrder_id = $request->id;
        $saleOrder = $this->getOne($saleOrder_id);

        if($saleOrder){
            // 確認付款 unpaidAmount paidAmount
            $saleOrder->paid_at = NULL;

            $totalTaxPrice = $saleOrder->totalTaxPrice;
            $orig_paid = $saleOrder->paidAmount;
            $orig_overpaidAmount = $saleOrder->overpaidAmount;

            $saleOrder->paidAmount = 0;
            $saleOrder->unpaidAmount = $totalTaxPrice;
            $saleOrder->overpaidAmount = 0;

            // 加回客戶未結款項
            $saleOrder->consumer->uncheckedAmount += $orig_paid + $orig_overpaidAmount;
            $saleOrder->consumer->save();
            $saleOrder->last_user_id = Auth::id();
            $saleOrder->save();
        }else{
            return 'Sale Order Not Found';
        }
    }

    public function generateShownID(){
        $today = Carbon::today()->toDateTimeString();   //2019-12-26 00:00:00
        $today = substr($today, 0, 10);                 //2019-12-26
        $today = str_replace('-', '', $today);            //20191226
        $count = SalesOrderEloquent::where('shown_id', 'like', 'S' . $today . '%')->count();
        $count += 1;
        $count = str_pad($count, 4, '0', STR_PAD_LEFT);
        $shown_id = 'S' . $today . $count;                  //S201912260001
        return $shown_id;
    }
}
