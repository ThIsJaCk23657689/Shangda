<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\NotificationService;
use App\Consumer as ConsumerEloquent;
use App\PurchaseOrder as PurchaseOrderEloquent;
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

            if($day >= $monthlyCheckDate){ //超過月結日
                $this->NotificationService->monthlyCheckDateExpired($consumer->id);
            }
        }

        //原物料進貨單逾期通知
        //$this->NotificationService->purchaseOrderExpired($purchase_order_id)
    }
}
