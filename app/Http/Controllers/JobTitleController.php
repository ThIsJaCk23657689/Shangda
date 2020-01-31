<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\JobTitleService;

class JobTitleController extends Controller
{
    
    public $JobTitleService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->JobTitleService = new JobTitleService();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobtitles = $this->JobTitleService->getList();
        $lastUpdate = $this->JobTitleService->getlastupdate();
        return view('jobTitles.index', compact('jobtitles', 'lastUpdate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jobTitles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:10'
        ]);
        $jobtitle = $this->JobTitleService->add($request);
        return redirect()->route('jobtitles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jobtitle = $this->JobTitleService->getOne($id);
        return view('jobTitles.show', compact('jobtitle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($id == 1 || $id == 2){
            abort(403, '無效的ID，廠商(1號)與基層員工(2號)不可被編輯。');
        }
        $jobtitle = $this->JobTitleService->getOne($id);
        return view('jobTitles.edit', compact('jobtitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($id == 1 || $id == 2){
            abort(403, '無效的ID，廠商(1號)與基層員工(2號)不可被編輯。');
        }

        $this->validate($request, [
            'name' => 'required|string|max:10'
        ]);
        $jobtitle = $this->JobTitleService->update($request, $id);
        return redirect()->route('jobtitles.show', [$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id == 1 || $id == 2){
            abort(403, '無效的ID，廠商(1號)與基層員工(2號)不可被刪除。');
        }
        $jobtitle = $this->JobTitleService->getOne($id);
        $users = $jobtitle->users;
        foreach($users as $user){
            $user->job_title_id = 2;
            $user->save();
        }
        $this->JobTitleService->delete($id);
        return redirect()->route('jobtitles.index');
    }
}
