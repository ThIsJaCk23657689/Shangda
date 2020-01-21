<?php

namespace App\Services\Logs;

use App\Services\BaseService;
use App\MaterialLog as MaterialLogEloquent;

class MaterialLogService extends BaseService
{
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
