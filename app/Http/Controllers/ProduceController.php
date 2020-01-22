<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProduceService;
use App\Services\ProductService;

class ProduceController extends Controller
{
    public $ProduceService;
    public $ProductService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->ProduceService = new ProduceService();
        $this->ProductService = new ProductService();
    }

    public function index(){
        $produces = $this->ProduceService->getList();
        $lastUpdate = $this->ProduceService->getlastupdate();
        return view('produces.index', compact('produces', 'lastUpdate'));
    }

    public function create(){
        $products = $this->ProductService->getList();
        return view('produces.create', compact('products'));
    }

    public function store(Request $request){
        return redirect()->route('produces.index');
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
}
