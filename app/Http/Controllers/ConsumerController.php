<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ConsumerRequest;
use App\Http\Requests\ConsumerEditRequest;
use App\Http\Requests\DiscountRequest;
use App\Services\ConsumerService;
use Illuminate\Validation\Rule;

class ConsumerController extends Controller
{
    public $ConsumerService;


    public function __construct()
    {
        $this->middleware('auth')->except('getDataByTaxID');
        $this->ConsumerService = new ConsumerService();
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
            'msg' => '成功新增' . count($request->discounts) . '筆折扣資料。'
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

    public function getDataByTaxID($taxID){

        // use key 'http' even if you send the request to https://...
        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'GET',
                'content' => null,
            ]
        ];

        // 先查詢此統編的類型 (公司、分公司、商業)
        $data = [
            '$format' => 'json',
            '$filter' => 'No eq ' . $taxID,
            '$skip' => 0,
            '$top' => 50
        ];
        $url = 'http://data.gcis.nat.gov.tw/od/data/api/673F0FC0-B3A7-429F-9041-E9866836B66D?' . http_build_query($data);

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        // $result 是string 必須先轉成array
        $result = json_decode($result, true);

        if ($result === FALSE){
            return response()->json([
                'status' => '4',
                'msg' => '判斷統一編號時發生錯誤。',
                'result' => $result
            ]);
        }

        if($result[0]["exist"] == "Y"){
            $type = "公司";
        }else if($result[1]["exist"] == "Y"){
           $type  = "分公司";
            return response()->json([
                'status' => '2',
                'type' => $type
            ]);
        }else if($result[2]["exist"] == "Y"){
            $type = "商業";
            return response()->json([
                'status' => '1',
                'type' => $type
            ]);
        }else{
            $status_code = "invaild";
            $type = "無效";
            return response()->json([
                'status' => '0',
                'type' => $type
            ]);
        }

        $data = [
            '$format' => 'json',
            '$filter' => 'Business_Accounting_NO eq ' . $taxID,
            '$skip' => 0,
            '$top' => 50
        ];
        $url = 'http://data.gcis.nat.gov.tw/od/data/api/5F64D864-61CB-4D0D-8AD9-492047CC1EA6?' . http_build_query($data);

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        // $result 是string 必須先轉成array
        $result = json_decode($result, true);

        // return var_dump($result);

        if ($result === FALSE){
            return response()->json([
                'status' => '4',
                'msg' => '撈取統一編號時發生錯誤。',
                'result' => $result
            ]);
        }

        return response()->json([
            'status' => '3',
            'type' => $type,
            'result' => $result
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
