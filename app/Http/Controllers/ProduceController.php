<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProduceRequest;
use App\Http\Requests\ProduceDetailRequest;

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
        return view('produces.edit');
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
    //商品細項刪除
    public function detailProductDelete($id){
        $this->ProduceDetailService->productDelete($id);
        return redirect()->route('produces.index');
   }
}
