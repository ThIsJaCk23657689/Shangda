<?php

namespace App\Services\Logs;

use App\Services\BaseService;
use App\MaterialLog as MaterialLogEloquent;

class MaterialLogService extends BaseService
{
    // 1.進貨新增 2.進貨修改 3.進貨刪除 4.原料使用 5.原料使用修改 6.原料使用刪除 7.確認到貨 8.取消到貨 9.確認付款 10.取消付款
    public function add($user_id, $material_id, $act, $amount)
    {
        $material_log = MaterialLogEloquent::create([
            'user_id' => $user_id,
            'material_id' => $material_id,
            'act' => $act,
            'amount' => $amount,
        ]);

        return $material_log;
    }

    public function getList()
    {
        $material_logs = MaterialLogEloquent::get();
        return $material_logs;
    }
}
