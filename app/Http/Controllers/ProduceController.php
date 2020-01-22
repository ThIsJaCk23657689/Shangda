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

    public function store(ProduceRequest $request){
        $produce = $this->ProduceService->add($request);
        return response()->json([
            'produce_id' => $produce->id,
            'massenge' => '編號' . $produce->id . '建立成功。',
            'status' => 'OK'
        ]);
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
        return redirect()->route('produces.show', [$id]);
    }

    public function destroy($id){
        $produce = $this->ProduceService->getOne($id);
        return redirect()->route('produces.index');
    }

    // Produce Detail Function
    public function detailstore(ProduceDetailRequest $request){
        $msg = $this->ProduceDetailService->add($request);
        return response()->json($msg, 200);
    }
}
