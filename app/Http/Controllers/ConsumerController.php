<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ConsumerRequest;
use App\Services\ConsumerService;
use App\Services\DiscountService;

use App\Consumer as ConsumerEloquent;

class ConsumerController extends Controller
{
    public $ConsumerService;
    public $DiscountService;
    

    public function __construct()
    {
        $this->middleware('auth');
        $this->ConsumerService = new ConsumerService();
        $this->DiscountService = new DiscountService();
    }

    public function index()
    {
        $consumer = $this->ConsumerRequest->getList();
        $lastUpdate = $this->ConsumerRequest->getlastupdate();
        return view('consumers.index', compact('consumer', 'lastUpdate'));
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
        return view('consumers.show', compact('comsumer'));
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

    //以顧客ID尋找相關折扣，若無回傳0
    public function showDiscountList($id)
    {
        $discountList = $this->DiscountService->getDiscountList($id);
        return view('consumers.showDiscount', compact('discountList'));
    }
}
