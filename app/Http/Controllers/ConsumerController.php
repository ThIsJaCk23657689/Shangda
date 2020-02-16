<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ConsumerRequest;
use App\Http\Requests\ConsumerEditRequest;
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
        $consumers = $this->ConsumerService->getList();
        $lastUpdate = $this->ConsumerService->getlastupdate();
        return view('consumers.index', compact('consumers', 'lastUpdate'));
    }

    public function create()
    {
        return view('consumers.create');
    }

    public function store(ConsumerRequest $request)
    {
        $consumer = $this->ConsumerService->add($request);
        return redirect()->route('consumers.index');
    }

    public function show($id)
    {
        $consumer = $this->ConsumerService->getOne($id);
        return view('consumers.show', compact('consumer'));
    }

    public function edit($id)
    {
        $consumer = $this->ConsumerService->getOne($id);
        return view('consumers.edit', compact('consumer'));
    }

    public function update(ConsumerEditRequest $request, $id)
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

    // ========== Response JSON ==========
    public function showName(){
        $comsumer = $this->ConsumerService->getNamesList();
        return response()->json($comsumer, 200);
    }

    public function getInfo(Request $request){
        $comsumer_info = $this->ConsumerService->getInfoList($request->id);
        return response()->json($comsumer_info, 200);
    }
}
