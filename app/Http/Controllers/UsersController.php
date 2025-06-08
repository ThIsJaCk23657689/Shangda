<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    public $UserService;

    public function __construct(){
        $this->middleware(['auth', 'job.title:4,3']);
        $this->UserService = new UserService();
    }
    
    public function index(){
        $users = $this->UserService->getList();
        $lastUpdate = $this->UserService->getlastupdate();
        return view('users.index', compact('users', 'lastUpdate'));
    }

    public function create(){
        return view('users.create');
    }

    public function store(UserRequest $request){
        $result = $this->UserService->add($request);
        return response()->json([
            'message' => $result['message'], 
            'url' => route('users.index')
        ], $result['status']);
    }

    public function show($id){
        $user = $this->UserService->getOne($id);
        return view('users.show', compact('user'));
    }

    public function edit($id){
        if($id == 1){
            return redirect()->route('users.index');
        }
        
        $user = $this->UserService->getOne($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'jobTitle' => 'nullable|integer|exists:job_titles,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'gender' => 'required|boolean',
            'birthday' => 'nullable|date',
            'tel' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20',

            'address_zipcode' => 'nullable|string|size:3',
            'address_county' => 'nullable|string|max:10',
            'address_district' => 'nullable|string|max:10',
            'address_others' => 'nullable|string|max:255',
            'comment' => 'nullable|string|max:255',
        ]);

        if($id == 1){
            // 管理員不能修改資訊
            return redirect()->route('users.index');
        }
        
        $result = $this->UserService->update($request, $id);
        return response()->json([
            'message' => $result['message'], 
            'url' => route('users.show', [$id]),
        ], $result['status']);
    }

    public function destroy($id){
        $this->UserService->delete($id);
        return redirect()->route('users.index');
    }

    public function getOne($id){
        $user = $this->UserService->getOne($id);
        return response()->json([
            'status' => 'OK',
            'user' => $user
        ]);
    }
}
