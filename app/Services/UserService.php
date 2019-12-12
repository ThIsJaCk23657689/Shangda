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
        $users = UserEloquent::get();
        return $users;
    }

    public function getOne($id)
    {
        $user = UserEloquent::find($id);
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
        $user->delete();
    }

    public function getlastupdate()
    {
        $user = UserEloquent::orderBy('id', 'DESC')->first();
        if(!empty($user)){
            return $user->updated_at;
        }

        return null;
    }
}