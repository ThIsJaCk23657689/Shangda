<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductController extends Controller
{
    public $ProductService;

    public function __construct()
    {
        $this->ProductService = new ProductService();
    }

    public function index(){
        return view('frontend.products.index');
    }

    public function list(Request $request){

    }

    public function show($id){
        $product = $this->ProductService->getOne($id);
        return view('frontend.products.show', compact('product'));
    }
}
