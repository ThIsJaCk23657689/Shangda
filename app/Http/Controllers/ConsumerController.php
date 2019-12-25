<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ConsumerRequest;
use App\Services\ConsumerService;

use App\Consumer as ConsumerEloquent;

class ConsumerController extends Controller
{
    public $ConsumerService;
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->ConsumerService = new ConsumerService();
    }


    public function index()
    {
        $consumer = $this->ConsumerRequest->getList();
        $lastUpdate = $this->ConsumerRequest->getlastupdate();
        return view('consumer.index', compact('consumer', 'lastUpdate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('consumers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConsumerRequest $request)
    {
        $comsumer = $this->ConsumerService->add($request);
        return redirect()->route('consumers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comsumer = $this->ConsumerService->getOne($id);
        return view('comsumers.show', compact('comsumer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $consumer = $this->ConsumerService->getOne($id);
        return view('consumers.edit', compact('consumer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConsumerRequest $request, $id)
    {
        $consumer = $this->ConsumerService->update($request, $id);
        return redirect()->route('consumers.show', [$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->ConsumerService->delete($id);
        return redirect()->route('consumers.index');
    }
}
