<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductQuantityService;
use App\Services\ProductService;

class ProductQuantityController extends Controller
{
    public $ProductQuantityService;
    public $ProductService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->ProductQuantityService = new ProductQuantityService();
        $this->ProductService = new ProductService();
    }

    public function index(){
        $pqs = $this->ProductQuantityService->getList();
        return view('products.quantities.index', compact('pqs'));
    }

    public function create(){
        $products = $this->ProductService->getList();
        return view('products.quantities.create', compact('products'));
    }

    public function store(Request $request){
        return redirect()->route('products.quantities.index');
    }

    public function show($id){
        $pq = $this->ProductQuantityService->getOne($id);
        return view('products.quantities.show', compact('pq'));
    }

    public function edit($id){
        $pq = $this->ProductQuantityService->getOne($id);
        return view('products.quantities.edit');
    }

    public function update(Request $request, $id){
        return redirect()->route('products.quantities.show', [$id]);
    }

    public function destroy($id){
        $pq = $this->ProductQuantityService->getOne($id);
        return redirect()->route('products.quantities.index');
    }
}
