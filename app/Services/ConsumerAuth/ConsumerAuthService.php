<?php

namespace App\Services\ConsumerAuth;

use App\Services\BaseService;
use App\Consumer as ConsumerEloquent;
use Carbon\Carbon;
use JWTAuth;

class ConsumerAuthService extends BaseService
{   
    public function resetPassword($request){
        $re = $request->all();
        $token = JWTAuth::getToken();
        $consumer = JWTAuth::toUser($token);
        if ($re['new_pwd'] != $re['conf_pwd']) {
            return $msg = "兩次密碼不一致";
        } else {
            if (password_verify($re['old_pwd'], $consumer->pwd)) {
                $consumer->pwd = bcrypt($re['new_pwd']);
                $consumer->save();
                if (ConsumerEloquent::count() != 0)
                    return $msg = "重設密碼成功";
                else
                    return $msg = "重設密碼失敗";
            } else {
                return $msg = "原本密碼錯誤";
            }
        }
    }
}
