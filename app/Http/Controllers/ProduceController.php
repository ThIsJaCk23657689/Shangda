<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Requests\ProduceRequest;
// use App\Http\Requests\ProduceDetailRequest;
use App\Services\ProduceService;
use App\Services\ProductService;
use App\Services\ProduceDetailService;

class ProduceController extends Controller
{
    public $ProduceService;
    public $ProductService;
    public $ProduceDetailService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->ProduceService = new ProduceService();
        $this->ProductService = new ProductService();
        $this->ProduceDetailService = new ProduceDetailService();
    }

    public function index(){
        $produces = $this->ProduceService->getList();
        $lastUpdate = $this->ProduceService->getlastupdate();
        return view('produces.index', compact('produces', 'lastUpdate'));
    }

    public function create(){
        return view('produces.create');
    }

    public function store(Request $request){
        $result = $this->ProduceService->add($request);
        return response()->json($result, $result['status']);
    }

    public function show($id){
        $produce = $this->ProduceService->getOne($id);
        return view('produces.show', compact('produce'));
    }

    public function edit($id){
        $produce = $this->ProduceService->getOne($id);
        return view('produces.edit', compact('produce'));
    }

    public function update(Request $request, $id){
        $msg = $this->ProduceService->update($request, $id);
        return response()->json($msg, $msg['status']);
    }

    public function destroy($id){
        $this->ProduceService->delete($id);
        return redirect()->route('produces.index');
    }

    // Produce Detail Function
    public function detailstore(Request $request){
        $result = $this->ProduceDetailService->add($request);
        return response()->json($result, $result['status']);
    }

    public function detailupdate(Request $request){
        $result = $this->ProduceDetailService->update($request);
        return response()->json($result, $result['status']);
    }

    // 原物料細項修改(只能改數量)
    public function detailMaterialUpdate(Request $request, $id){
        $msg = $this->ProduceDetailService->materialUpdate($request, $id);
        return response()->json($msg, 200);
    }
    // 商品細項修改(只能改數量)
    public function detailProductUpdate(Request $request, $id){
        $msg = $this->ProduceDetailService->productUpdate($request, $id);
        return response()->json($msg, 200);
    }

    // 原物料細項刪除
    public function detailMaterialDelete($id){
        $this->ProduceDetailService->materialDelete($id);
        return redirect()->route('produces.index');
    }

    // 商品細項刪除
    public function detailProductDelete($id){
        $this->ProduceDetailService->productDelete($id);
        return redirect()->route('produces.index');
    }

    // 取得商品庫存的詳細資料（json格式）
    public function getOne($id){
        $produce = $this->ProduceService->getOne($id);
        $produce['produce_details'] = $produce->produceDetails;
        $produce['produce_products'] = $produce->produceProducts;

        $count = 0;
        foreach($produce->produce_details as $detail){
            $detail['material'] = $detail->material;
            $detail['material']['showStock'] = $detail->material->showStock();
            $detail['material']['showUnit'] = $detail->material->showUnit();
            $detail['count'] = $count++;
            $detail['currentQty'] = ($detail->material->showStock + $detail->quantity);
            $detail['afterQty'] = $detail->material->showStock;
        }

        $count = 0;
        foreach($produce->produce_products as $detail){
            $detail['product'] = $detail->product;
            $detail['product']['showUnit'] = $detail->product->showUnit();
            $detail['count'] = $count++;
            $detail['currentQty'] = ($detail->product->quantity - $detail->quantity);
            $detail['afterQty'] = $detail->product->quantity;
        }

        return response()->json([
            'produce' => $produce
        ], 200);
    }
}
