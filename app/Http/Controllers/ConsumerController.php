<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ConsumerRequest;
use App\Http\Requests\ConsumerEditRequest;
use App\Http\Requests\DiscountRequest;
use App\Services\ConsumerService;

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
}
