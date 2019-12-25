<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
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

    public function store(Request $request){
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'boolean'],
            'jobTitle' => ['required', 'integer', 'exists:job_titles,id'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        $user = $this->UserService->add($request);
        return redirect()->route('users.index');
    }

    public function show($id){
        $user = $this->UserService->getOne($id);
        return view('users.show', compact('user'));
    }

    public function edit($id){
        $user = $this->UserService->getOne($id);
        $jobTitles = $this->JobTitleService->getList();
        return view('users.edit', compact('user', 'jobTitles'));
    }

    public function update($id, Request $request){
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'boolean'],
            'jobTitle' => ['required', 'integer', 'exists:job_titles,id'],
        ]);
        
        $user = $this->UserService->update($request, $id);
        return redirect()->route('users.show', [$id]);
    }

    public function destroy($id){
        $this->UserService->delete($id);
        return redirect()->route('users.index');
    }
}
