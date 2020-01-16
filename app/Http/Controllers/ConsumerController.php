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

    public function create()
    {
        return view('consumers.create');
    }

    public function store(ConsumerRequest $request)
    {
        $comsumer = $this->ConsumerService->add($request);
        return redirect()->route('consumers.index');
    }

    public function show($id)
    {
        $comsumer = $this->ConsumerService->getOne($id);
        return view('comsumers.show', compact('comsumer'));
    }

    public function edit($id)
    {
        $consumer = $this->ConsumerService->getOne($id);
        return view('consumers.edit', compact('consumer'));
    }

    public function update(ConsumerRequest $request, $id)
    {
        $consumer = $this->ConsumerService->update($request, $id);
        return redirect()->route('consumers.show', [$id]);
    }

 
    public function destroy($id)
    {
        $this->ConsumerService->delete($id);
        return redirect()->route('consumers.index');
    }
}
