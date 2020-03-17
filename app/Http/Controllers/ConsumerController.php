<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ConsumerRequest;
use App\Http\Requests\ConsumerEditRequest;
use App\Http\Requests\DiscountRequest;
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

    // 顯示此顧客的折扣頁面
    public function showDiscountsPage($id){
        $consumer = $this->ConsumerService->getOne($id);
        return view('discounts.edit.consumer', compact('consumer'));
    }

    // 編輯客戶的折扣資訊
    public function editDiscounts(DiscountRequest $request, $id){
        $comsumer = $this->ConsumerService->getOne($id);
        
        // 先將先前的所有折扣商品資料全數刪除
        $comsumer->products()->detach();

        // 再新增目前的折扣資料
        foreach($request->discounts as $discount){
            $product_id = $discount['product_id'];
            $price = $discount['relativePrice'];

            if($price != 0){
                $comsumer->products()->attach($product_id, [
                    'price' => $price,
                ]);
            }
        }
        return response()->json([
            'status' => 'OK',
            'msg' => '成功新增' . count($request->discounts) . '筆折扣資料。'
        ]);
	}
	
	// 取得顧客的折扣資料
	public function getDiscountsList($id){
		$comsumer = $this->ConsumerService->getOne($id);
		$discounts = $comsumer->products()
			->select(['id', 'shownID', 'name', 'costprice', 'profit', 'retailPrice'])
			->get();
		
		foreach($discounts as $discount){
			$discount['showUnit'] = $discount->showUnit();
		}

		return response()->json([
			'status' => 'OK',
            'msg' => '成功取得顧客編號' . $id . '的折扣資料。',
			'discounts' => $discounts
		]);
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
