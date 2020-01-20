<?php

namespace App\Services;
use App\Material_log as Material_logEloquent;
use Carbon\Carbon;

class Material_logService extends BaseService
{
    public function add($user_id, $material_id, $act, $amount)
    {
        $material_log = Material_logEloquent::create([
            'user_id' => $user_id,
            'material_id' => $material_id,
            'act' => $act,
            'amount' => $amount,
        ]);

        return $material_log;
    }

    public function getList()
    {
        $material_logs = Material_logEloquent::get();
        return $material_logs;
    }
}
