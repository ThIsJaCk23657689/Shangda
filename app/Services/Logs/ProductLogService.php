<?php

namespace App\Services\Logs;

use App\Services\BaseService;
use App\ProductLog as ProductLogEloquent;

class ProductLogService extends BaseService
{
    public function add($user_id, $product_id, $act, $amount)
    {
        // 1.訂單細項新增 2.訂單細項修改 3.訂單細項刪除 4.存貨新增 5.存貨修改 6.存貨刪除 7.確認出貨 8.取消出貨 9.確認付款 10.取消付款
        // 11.確認退貨退款 12.取消退貨退款  13.退貨單細項新增 14.退貨單細項修改 15.退貨單細項刪除
        $product_log = ProductLogEloquent::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'act' => $act,
            'amount' => $amount,
        ]);

        return $product_log;
    }

    public function getList()
    {
        $product_logs = ProductLogEloquent::get();
        return $product_logs;
    }

}
