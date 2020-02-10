<?php

namespace App\Services;
use App\Notification as NotificationEloquent;
use App\Material as MaterialEloquent;
use App\Consumer as ConsumerEloquent;

use App\Events\AddSaleOrderEvnet;
use App\Events\MaterialUnderSafeEvent;
use App\Events\MonthlyCheckDateExpiredEvent;


class NotificationService extends BaseService
{
    public function read($request)
    {
        $notice = $this->getOne($request->id);
        $notice->status = 1;
        $notice->save();

        return $notice;
    }

    public function getList()
    {
        $notices = NotificationEloquent::get();
        return $notices;
    }

    public function getOne($id)
    {
        $notice = NotificationEloquent::findOrFail($id);
        return $notice;
    }

    // 新建銷貨單通知 => joBTitle >=3
    public function addSaleOrderNotice($saleOrder_id){

        $notice = NotificationEloquent::create([
            'job_title_id' => 3,
            'type' => 1,
            'status' => 0,
            'comment' => '有新的銷售單建立!'
        ]);
        broadcast(new AddSaleOrderEvnet($notice, $saleOrder_id))->toOthers();
    }

    // 原物料庫存低於安全庫存通知 => joBTitle >= 2 (暫定)
    public function materialUnderSafe($material_id){
        $material = MaterialEloquent::findOrFail($material_id);
        $material_name = $material->name;
        $notice_comment = '原物料 '.$material_name.' 目前存量低於安全庫存量';
        $notice = NotificationEloquent::create([
            'job_title_id' => 2,
            'type' => 2,
            'status' => 0,
            'comment' => $notice_comment
        ]);
        broadcast(new MaterialUnderSafeEvent($notice, $material_id))->toOthers();
    }

    // 月結日期到結帳通知 => joBTitle >= 2 (暫定)
    public function monthlyCheckDateExpired($consumer_id){
        $consumer = ConsumerEloquent::findOrFail($consumer_id);
        $consumer_name = $consumer->name;
        $uncheckedAmount = $consumer->uncheckedAmount;
        $notice_comment = '客戶 '.$consumer_name.' 月結日已到期，尚有未結帳之訂單';
        $notice = NotificationEloquent::create([
            'job_title_id' => 2,
            'type' => 3,
            'status' => 0,
            'comment' => $notice_comment
        ]);
        broadcast(new MonthlyCheckDateExpiredEvent($notice, $consumer_id, $uncheckedAmount))->toOthers();
    }

    //原物料進貨單逾期通知 => joBTitle >= 2 (暫定)
    public function purchaseOrderExpired($purchase_order_id){
        $notice_comment = '有進貨單已逾期未到貨';
        $notice = NotificationEloquent::create([
            'job_title_id' => 2,
            'type' => 4,
            'status' => 0,
            'comment' => $notice_comment
        ]);
        broadcast(new PurchaseOrderExpiredEvent($notice, $purchase_order_id))->toOthers();
    }

}
