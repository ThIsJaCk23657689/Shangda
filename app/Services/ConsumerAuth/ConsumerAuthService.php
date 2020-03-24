<?php

namespace App\Services;
use App\Consumer as ConsumerEloquent;
use Carbon\Carbon;

class ConsumerAuthService extends BaseService
{
    
    public function register($request){
        if($request->pwd != $request->conf_pwd){
            return "兩次密碼不一致";
        }else{
            $consumer = ConsumerEloquent::create([
                'name' => $request->name,
                'shortName' => $request->shortName,
                'act' => $request->act,
                'pwd' => bcrypt($request->pwd),
                'taxID' => $request->taxID,
                'idNumber' => strtoupper($request->idNumber),
                'inCharge1' => $request->inCharge1,
                'tel1' => $request->tel1,
                'email1' => $request->email1,
                'inCharge2' => $request->inCharge2,
                'tel2' => $request->tel2,
                'email2' => $request->email2,
                'tax' => $request->tax,
                'monthlyCheckDate' => $request->monthlyCheckDate,
                'uncheckedAmount' => $request->uncheckedAmount,
                'totalConsumption' => $request->totalConsumption,
                'comment' => $request->comment,
                'companyAddress' => $request->companyAddress,
                'deliveryAddress' => $request->deliveryAddress,
                'invoiceAddress' => $request->invoiceAddress,
            ]);

            return "註冊成功";
        }

    }

    public function login($request){
        $ex_time = Carbon::now()->addHour(5)->timestamp;
        $account = $request->act;
        $password = $request->pwd;
        $consumer = ConsumerEloquent::where('act', $account)->first();
        if ($account == "" && $password == "") {
            //400
            $msg[] = '請輸入帳號和密碼';
            // return response()->json($msg, 400, $headers, JSON_UNESCAPED_UNICODE);
        } else if ($password == "") {
            $msg[] = '請輸入密碼';
        } else if ($account == "") {
            $msg[] = '請輸入帳號';
        }
        if ($consumer) {
            if (password_verify($password['password'], $consumer->pwd)) {
                $token = JWTAuth::attempt($consumer, ['exp' => $ex_time]);
                try {
                    if (!$token) { // 401
                        $msg[] = "invalid_credentials";
                    }
                } catch (JWTException $e) { // 500
                    $msg[] = "could_not_create_token";
                }
                $cookie_token = 'Bearer ' . $token;
                // return response()->json($token)->cookie('authorization', $cookie_token, 200);
                $msg[] = "登入成功";
                $msg[] = $token;
                $msg[] = $cookie_token;
            }else{
                $msg[] = '密碼錯誤';
            }
        }else{
            $msg[] = '帳號不存在';
        }

        return $msg;
    }

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
