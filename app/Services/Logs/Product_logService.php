<?php

namespace App\Services;
use App\Product_log as Product_logEloquent;

class Product_logService extends BaseService
{
    public function add($user_id, $product_id, $act, $amount)
    {
        $product_log = Product_logEloquent::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'act' => $act,
            'amount' => $amount,
        ]);

        return $product_log;
    }

    public function getList()
    {
        $product_logs = Product_logEloquent::get();
        return $product_logs;
    }

}
