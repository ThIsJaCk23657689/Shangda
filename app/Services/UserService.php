<?php

namespace App\Services;
use App\User as UserEloquent;
use Auth;
use Log;

class UserService extends BaseService
{
    public function add($request)
    {
        $user = UserEloquent::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'email' => $request->email,
            'account' => $request->account,
            'password' => bcrypt($request->password),
            'birthday' => $request->birthday,
            'tel' => $request->tel,
            'phone' => $request->phone,

            'address_zipcode' => $request->address_zipcode,
            'address_county' => $request->address_county,
            'address_district' => $request->address_district,
            'address_others' => $request->address_others,

            'comment' => $request->comment,
        ]);

        if(!$user){
            return [
                'status' => 422,
                'message' => '新增員工時發生錯誤！'
            ];
        }

        if(!empty($request->jobTitle)){
            $user->job_title_id = $request->jobTitle;
            $user->save();
        }
        
        return [
            'status' => 200,
            'message' => '新增員工：' . $user->name . '，成功！'
        ];
    }

    public function getList()
    {
        $users = UserEloquent::withTrashed()->get();
        return $users;
    }

    public function getOne($id)
    {
        $user = UserEloquent::withTrashed()->findOrFail($id);
        return $user;
    }

    public function update($request, $id)
    {
        $user = $this->getOne($id);
        $user->update([
            'name' => $request->name,
            'gender' => $request->gender,
            'email' => $request->email,
            'birthday' => $request->birthday,
            'tel' => $request->tel,
            'phone' => $request->phone,

            'address_zipcode' => $request->address_zipcode,
            'address_county' => $request->address_county,
            'address_district' => $request->address_district,
            'address_others' => $request->address_others,

            'comment' => $request->comment,
        ]);

        if(!$user){
            return [
                'status' => 422,
                'message' => '編輯員工資料時發生錯誤！'
            ];
        }

        if(!empty($request->jobTitle)){
            $user->job_title_id = $request->jobTitle;
            $user->save();
        }
        
        return [
            'status' => 200,
            'message' => '編輯員工資料成功！'
        ];
    }

    public function delete($id)
    {
        $act_user = Auth::user();
        $user = $this->getOne($id);

        // 本人不能刪除, 最高管理者不能刪
        if($act_user->id != $id && $id != 1){
            if($user->trashed()){
                $user->restore();
                Log::channel('users')->info('編號：' . $act_user->id . '，姓名：' . $act_user->name . ' 解除了 編號：' . $user->id . '，姓名：' . $user->name . ' 的停權限制。');
            }else{
                $user->delete();
                Log::channel('users')->info('編號：' . $act_user->id . '，姓名：' . $act_user->name . ' 停權了 編號：' . $user->id . '，姓名：' . $user->name . '。');
            }
        }
    }

    public function getlastupdate()
    {
        $user = UserEloquent::withTrashed()->orderBy('id', 'DESC')->first();
        if(!empty($user)){
            return $user->updated_at;
        }

        return null;
    }
}