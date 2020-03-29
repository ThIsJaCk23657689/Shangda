<?php

namespace App\Services\Orders;
use App\Services\BaseService;
use App\SalesOrder as SalesOrderEloquent;
use App\Product as ProductEloquent;
use App\Services\NotificationService;
use App\Services\Logs\ProductLogService;
use Auth;
use Carbon\Carbon;

class ReturnOrderService extends BaseService
{
    public $NotificationService;
    public $ProductLogService;

    public function __construct()
    {
        //11.確認退貨退款 12.取消退貨退款
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
            'paid_at' => $request->paid_at,
            'expectDeliver_at' => $request->expectDeliver_at,
            'delivered_at' => $request->delivered_at,
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
        ]);

        // 發送通知
        // $this->NotificationService->addSaleOrderNotice($saleOrder->id);

        return $saleOrder;
    }

    public function getList()
    {
        $saleOrders = SalesOrderEloquent::where('status', 2)->get();
        return $saleOrders;
    }

    public function getOne($id)
    {
        $saleOrder = SalesOrderEloquent::find($id);
        return $saleOrder;
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
            // $saleOrder->consumer->uncheckedAmount =  $saleOrder->consumer->uncheckedAmount - $request->taxPrice + $request->taxPrice*1.05;
            // $saleOrder->consumer->save();
        }

        return $saleOrder;
    }

    public function delete($id)
    {
        $saleOrder = $this->getOne($id);
        // $saleOrder->consumer->uncheckedAmount -= $saleOrder->totalTaxPrice;
        // $saleOrder->consumer->save();
        $saleOrder->delete();
    }

    public function getlastupdate()
    {
        $saleOrder = SalesOrderEloquent::where('status', 2)->orderBy('id', 'DESC')->first();
        if(!empty($saleOrder)){
            return $saleOrder->updated_at;
        }

        return null;
    }


    // 確認退款(totalTaxPrice 月結客戶直接從uncheckedAmount減 totalConsumption也要減)
    public function refundConfirm($id){
        $returnOrder = $this->getOne($id);
        $returnOrder->paid_at = Carbon::today()->toDateTimeString();;
        // $returnOrderDetails = $returnOrder->details();
        // foreach($returnOrderDetails as $detail){
        //     $product = ProductEloquent::findOrFail($detail->product_id);
        //     $product->quantity = $product->quantity + $detail->quantity;
        //     $product->save();
        //     $this->ProductLogService->add(Auth::id(), $detail->product_id, 11, $detail->quantity);
        // }
        // 月結客戶
        if($returnOrder->consumer->monthlyCheckDate != 0){
            $returnOrder->consumer->uncheckedAmount -= $returnOrder->totalTaxPrice;
            $returnOrder->consumer->totalConsumption -= $returnOrder->totalConsumption;
            $returnOrder->consumer->save();

            // 發送通知
            $this->NotificationService->refundConfirmedNotice($returnOrder->consumer->id, $id);

        }else{
            // 非月結客戶 直接現場退費
            $returnOrder->consumer->totalConsumption -= $returnOrder->totalConsumption;
            $returnOrder->consumer->save();
        }
        return null;
    }

    public function generateShownID(){
        $today = Carbon::today()->toDateTimeString();   //2019-12-26 00:00:00
        $today = substr($today, 0, 10);                 //2019-12-26
        $today = str_replace('-', '', $today);            //20191226
        $count = SalesOrderEloquent::where('shown_id', 'like', 'R' . $today . '%')->count();
        $count += 1;
        $count = str_pad($count, 4, '0', STR_PAD_LEFT);
        $shown_id = 'R' . $today . $count;                  //R201912260001
        return $shown_id;
    }
}
