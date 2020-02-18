<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UserRequest;
use App\Services\JobTitleService;

class UsersController extends Controller
{
    public $UserService;
    public $JobTitleService;

    public function __construct(){
        $this->middleware('auth');
        $this->UserService = new UserService();
        $this->JobTitleService = new JobTitleService();
    }
    
    public function index(){
        $users = $this->UserService->getList();
        $lastUpdate = $this->UserService->getlastupdate();
        return view('users.index', compact('users', 'lastUpdate'));
    }

    public function create(){
        $jobTitles = $this->JobTitleService->getList();
        return view('users.create', compact('jobTitles'));
    }

    public function store(UserRequest $request){
        $user = $this->UserService->add($request);
        return redirect()->route('users.index');
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
        $jobTitles = $this->JobTitleService->getList();
        return view('users.edit', compact('user', 'jobTitles'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'jobTitle' => 'nullable|integer|exists:job_titles,id',
            'name' => 'required|string|max:255',
            'gender' => 'required|boolean',
            'birthday' => 'nullable|date',

            'zipcode' => 'nullable|string|size:3',
            'county' => 'nullable|string|max:10',
            'district' => 'nullable|string|max:10',
            'address' => 'nullable|string|max:255',
        ]);

        if($id == 1){
            return redirect()->route('users.index');
        }
        
        $user = $this->UserService->update($request, $id);
        return redirect()->route('users.show', [$id]);
    }

    public function destroy($id){
        $this->UserService->delete($id);
        return redirect()->route('users.index');
    }
}
