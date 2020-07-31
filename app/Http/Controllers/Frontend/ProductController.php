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
        $this->validate($request, [
            'keywords' => 'nullable| string|',
            'skip' => 'nullable| integer|',
            'orderby' => [
                'nullable',
                Rule::in([1, 2, 0]), //  1.價格(高->低) 2.價格(低->高)
            ],
            'type' => [
                'nullable',
                Rule::in([1, 2, 3, 0]), //type:(default) 0.全部 1.依商品名稱 2.依商品規格 3.依商品花色
            ],
        ]);

        $res = $this->ProductService->getListFrontend($request);

        return response()->json([
            'status' => 'OK',
            'DataTotalCount' => $res['count'],
            'products' => $res['products'],
        ]);
    }

    public function show($id){
        $product = $this->ProductService->getOne($id);
        return view('frontend.products.show', compact('product'));
    }

    public function getOnePictures($id)
    {
        $res = $this->ProductService->getOnePictures($id);

        return response()->json([
            'status' => $res['status'],
            'images' => $res['images'],
        ], $res['status']);
    }
}
