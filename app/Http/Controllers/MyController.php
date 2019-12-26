<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MyService;
use Auth;
use Validator;

class MyController extends Controller
{
    public $myService;

    public function __construct()
    {
        $this->myService = new MyService();
    }

    //region 採購
    public function createPurchaseOrder(Request $request)
    {
        $postData = $request->all();
        $objValidator = Validator::make(
            $postData,
            [
                's_id' => 'required|integer',
                'purchaser' => 'required|max:10|string',
                'purchaser_tel' => 'required|max:10|string',
                'purchaser_fax' => 'required|max:10|string',
                'delivery_time' => 'required|date',
                'delivery_place' => 'required|max:50|string',
                'payment_type' => 'required|integer|between:1,3',
                'remark' => 'sometimes|max:100|string',
                'purchaseItem' => 'required',
            ],
            [
                's_id.*' => '001問題',
                'purchaser.*' => '採購人問題',
                'purchaser_tel.*' => '採購人tel問題',
                'purchaser_fax.*' => '採購人fax問題',
                'delivery_time.*' => '交貨時間問題',
                'delivery_place.*' => '交貨地點問題',
                'payment_type.*' => '付款方式問題',
                'remark.*' => '備註問題',
                'purchaseItem.*' => '採購項目問題',
            ]
        );
        if ($objValidator->fails())
            return response()->json($objValidator->errors()->all(), 400, [], JSON_UNESCAPED_UNICODE);

        //物件陣列驗證物件內容
        $Rules = array(
            'm_id' => 'required|integer',
            'count' => 'required|integer',
            'price' => 'required|integer',
            'discount' => 'required|integer|between:1,10',
            'remark' => 'sometimes|max:100|string',
        );
        $Message = array(
            'm_id.*' => '002(採購項目)問題',
            'count.*' => '數量(採購項目)問題',
            'price.*' => '價格(採購項目)問題',
            'discount.*' => '折扣(採購項目)問題',
            'remark.*' => '備註(採購項目)問題',
        );

        foreach ($postData['purchaseItem'] as $Item) {
            $ItemJson = json_decode($Item, true);
            if (!$ItemJson) {
                $result = json_last_error();
                $resultStr = $this->MyService->getJson_last_error($result);
                return response()->json($resultStr, 400, [], JSON_UNESCAPED_UNICODE);
            }
            $validator = Validator::make($ItemJson, $Rules, $Message);
            if ($validator->fails()) {
                return response()->json($validator->errors()->all(), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }

        $result = $this->myService->createPurchaseOrder($postData);
        if ($result != "") {
            return response()->json($result, 400, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json('採購成功', 200, [], JSON_UNESCAPED_UNICODE);
        }
    }
    //endregion

    //region 取得採購單列
    public function getPurchaseOrderList()
    {
        $result = $this->myService->getPurchaseOrderList();
        return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE);
    }
    //endregion

    //region 取消採購
    public function deletePurchaseOrder(Request $request)
    {
        $postData = $request->all();
        $objValidator = Validator::make(
            $postData,
            [
                'po_id' => 'required|integer',
            ],
            [
                'po_id.*' => '001問題',
            ]
        );
        if ($objValidator->fails())
            return response()->json($objValidator->errors()->all(), 400, [], JSON_UNESCAPED_UNICODE);
        $result = $this->myService->deletePurchaseOrder($postData);
        if ($result != "") {
            return response()->json($result, 400, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json('取消成功', 200, [], JSON_UNESCAPED_UNICODE);
        }
    }
    //endregion

    //region 增加廠商
    public function addSuppliers(Request $request)
    {
        $postData = $request->all();
        $objValidator = Validator::make(
            $postData,
            [
                'supplier_name' => 'required|max:20|string',
                'contact_person' => 'required|max:20|string',
                'tel' => 'required|max:20|string',
                'fax' => 'required|max:20|string',
                'address' => 'required|max:20|string',
            ],
            [
                'supplier_name.*' => '廠商名問題',
                'contact_person.*' => '聯絡人問題',
                'tel.*' => '電話問題',
                'fax.*' => '傳真問題',
                'address' => '地址問題',
            ]
        );
        if ($objValidator->fails())
            return response()->json($objValidator->errors()->all(), 400, [], JSON_UNESCAPED_UNICODE);
        $result = $this->myService->addSuppliers($postData);
        if ($result != "") {
            return response()->json($result, 400, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json("新增成功", 200, [], JSON_UNESCAPED_UNICODE);
        }
    }
    //endregion

    //region 取得廠商列
    public function getSuppliersList()
    {
        $result = $this->myService->getSuppliersList();
        return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE);
    }
    //endregion

    //region 增加原料
    public function addMaterials(Request $request)
    {
        $postData = $request->all();
        $objValidator = Validator::make(
            $postData,
            [
                'material_name' => 'required|max:20|string',
                'stock' => 'required|integer',
            ],
            [
                'material_name.*' => '廠商名問題',
                'stock.*' => '聯絡人問題',
            ]
        );
        if ($objValidator->fails())
            return response()->json($objValidator->errors()->all(), 400, [], JSON_UNESCAPED_UNICODE);
        $result = $this->myService->addmaterials($postData);
        if ($result != "") {
            return response()->json($result, 400, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json("新增成功", 200, [], JSON_UNESCAPED_UNICODE);
        }
    }
    //endregion

    //region 取得原料列
    public function getMaterialsList()
    {
        $result = $this->myService->getMaterialsList();
        return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE);

    }
    //endregion


}
