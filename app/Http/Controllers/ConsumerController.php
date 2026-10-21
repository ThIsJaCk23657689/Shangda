<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ConsumerRequest;
use App\Http\Requests\ConsumerEditRequest;
use App\Http\Requests\DiscountRequest;
use App\Services\ConsumerService;
use App\Services\BusinessRegistryService;
use Illuminate\Validation\Rule;

class ConsumerController extends Controller
{
    public $ConsumerService;
    private BusinessRegistryService $businessRegistry;


    public function __construct(ConsumerService $consumerService, BusinessRegistryService $businessRegistry)
    {
        $this->middleware('auth')->except('getDataByTaxID');
        $this->middleware('job.title:4,3')->except([
            'getDataByTaxID',
            'showName',
            'getInfo',
            'getOne',
            'getList'
        ]);
        $this->ConsumerService = $consumerService;
        $this->businessRegistry = $businessRegistry;
    }

    public function index()
    {
        $DataTotalCount = $this->ConsumerService->count();
        return view('consumers.index', compact('DataTotalCount'));
    }

    public function create()
    {
        return view('consumers.create');
    }

    public function store(ConsumerRequest $request)
    {
        $result = $this->ConsumerService->add($request);
        return response()->json([
            'message' => $result['message'],
            'url' => route('consumers.index')
        ], $result['status']);
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
        $result = $this->ConsumerService->update($request, $id);
        return response()->json([
            'message' => $result['message'],
            'url' => route('consumers.show', [$id])
        ], $result['status']);
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
            'message' => '成功新增' . count($request->discounts) . '筆折扣資料。',
            'url' => route('discounts.index')
        ]);
	}

	// 取得顧客的折扣資料 回傳JSON格式
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

    public function getDataByTaxID(Request $request){
        return response()->json($this->businessRegistry->lookup((string) $request->input('taxID', '')));
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

    public function getOne($id){
        $consumer = $this->ConsumerService->getOne($id);
        return response()->json([
            'status' => 'OK',
            'consumer' => $consumer
        ]);
    }

    public function getList(Request $request){
        $this->validate($request, [
            // category: 0全部、1個人帳號、2公司帳號、3管理者創建、4顧客創建
            'category' => 'nullable|integer',

            // status: 0全部、1已封鎖、2未封鎖
            'status' => 'nullable|integer',

            // type: 0全部 1帳號 2名稱 3統編 4聯絡人名稱 5聯絡人電話 6未沖帳總額
            'type' => 'nullable|integer',

            'keywords' => 'nullable|string',
            'skip' => 'nullable|integer',
            'take' => 'nullable|integer|max:100',
            'orderby' => [
                'nullable',
                Rule::in([0, 1, 2, 3, 4]), //  1.建立日期(舊->新) 2.建立日期(新->舊) 3.更新日期(舊->新) 4.更新日期(新->舊)
            ],
        ]);

        $result = $this->ConsumerService->getList($request);

        return response()->json([
            'status' => 'OK',
            'DataTotalCount' => $result['count'],
            'consumers' => $result['consumers'],
            'request' => $request,
        ]);
    }
}
