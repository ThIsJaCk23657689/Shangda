<?php

namespace App\Services\Logs;

use App\Services\BaseService;
use App\ProductLog as ProductLogEloquent;

class ProductLogService extends BaseService
{
    public function add($user_id, $product_id, $act, $amount)
    {
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
