<?php

namespace App\Services;
use App\User as UserEloquent;
use Carbon\Carbon;

class UserService extends BaseService
{
    public function add($request)
    {
        $user = UserEloquent::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        if(!empty($request->jobTitle)){
            $user->job_title_id = $request->jobTitle;
            $user->save();
        }
        return $user;
    }

    public function getList()
    {
        $users = UserEloquent::withTrashed()->get();
        return $users;
    }

    public function getOne($id)
    {
        $user = UserEloquent::withTrashed()->find($id);
        return $user;
    }

    public function update($request, $id)
    {
        $user = $this->getOne($id);
        $user->update([
            'name' => $request->name,
            'gender' => $request->gender,
        ]);
        if(!empty($request->jobTitle)){
            $user->job_title_id = $request->jobTitle;
            $user->save();
        }
        return $user;
    }

    public function delete($id)
    {
        $user = $this->getOne($id);
        if($user->trashed()){
            $user->restore();
        }else{
            $user->delete();
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