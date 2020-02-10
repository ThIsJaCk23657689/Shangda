<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\NotificationService;
use App\Consumer as ConsumerEloquent;
use App\PurchaseOrder as PurchaseOrderEloquent;
use App\SaleOrder as SaleOrderEloquent;
use Carbon\Carbon;
class DailyCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily_check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'monthlyCheckDateExpired and purchaseOrderExpired Check';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public $NotificationService;

    public function __construct()
    {
        $this->NotificationService = new NotificationService();
        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // 月結日期到結帳通知
        //$this->NotificationService->monthlyCheckDateExpired($consumer_id)
        $today = Carbon::now();
        $day = $today->day;
        $consumers = ConsumerEloquent::all();
        foreach($consumers as $consumer){
            $monthlyCheckDate = $consumer->monthlyCheckDate;

            if($day >= $monthlyCheckDate && $consumer->uncheckedAmount > 0){ //超過月結日尚有未結帳金額
                $this->NotificationService->monthlyCheckDateExpired($consumer->id);
            }
        }

        //原物料進貨單逾期通知
        //$this->NotificationService->purchaseOrderExpired($purchase_order_id) expectReceived_at
        $purchaseOrders = PurchaseOrderEloquent::all();
        foreach($purchaseOrders as $purchaseOrder){
            $expectReceived_at = $purchaseOrder->expectReceived_at;
            if($today->gt($expectReceived_at) && $purchaseOrder->received_at==NULL){
                $this->NotificationService->purchaseOrderExpired($purchaseOrder->id);
            }
        }


        //預計出貨未出貨通知
        //$this->NotificationService->saleOrderExpired($sale_order_id) expectDeliver_at
        $saleOrders = SaleOrderEloquent::all();
        foreach($saleOrders as $saleOrder){
            $expectDeliver_at = $saleOrder->expectDeliver_at;
            if($today->gt($expectDeliver_at) && $saleOrder->delivered_at==NULL){
                $this->NotificationService->saleOrderExpired($saleOrder->id);
            }
        }
    }
}
