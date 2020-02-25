<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

use App\Services\ProductService;
use App\Services\CategoryService;

class ProductController extends Controller
{

    public $ProductService;
    public $CategoryService;

    public function __construct(){
        $this->middleware('auth');
        $this->ProductService = new ProductService();
        $this->CategoryService = new CategoryService();
    }

    public function index(){
        $products = $this->ProductService->getList();
        $lastUpdate = $this->ProductService->getlastupdate();
        return view('products.index', compact('products', 'lastUpdate'));
    }

    public function create(){
        $categories = $this->CategoryService->getList();
        return view('products.create', compact('categories'));
    }

    public function store(ProductRequest $request){
        $product = $this->ProductService->add($request);
        return response()->json([
            'product_id' => $product->id,
            'messenge' => '商品編號 ' . $product->shownID . ' 建立成功。',
            'redirect_url' => route('products.index'),
            'status' => 'OK'
        ]);
    }

    public function show($id){
        $categories = $this->CategoryService->getList();
        $product = $this->ProductService->getOne($id);
        $recipes = $product->materials;
        return view('products.show', compact(['categories', 'product', 'recipes']));
    }

    public function edit($id){
        $categories = $this->CategoryService->getList();
        $product = $this->ProductService->getOne($id);
        $recipes = $product->materials();
        return view('products.edit', compact(['categories', 'product', 'recipes']));
    }

    public function update(ProductRequest $request, $id){
        $product = $this->ProductService->update($request, $id);
        return redirect()->route('products.show', [$id]);
    }

    public function destroy($id){
        $this->ProductService->delete($id);
        return redirect()->route('products.index');
    }

    // ========== Response JSON ==========
    public function showName(){
        $product = $this->ProductService->getNamesList();
        return response()->json($product, 200);
    }

    public function getInfo(Request $request){
        $product_info = $this->ProductService->getInfoList($request->id);
        return response()->json($product_info, 200);
    }

    public function getProductListByCategory($category_id){
        $products = $this->ProductService->getProductByCategory($category_id);
        if($products == "此類別查無資料"){
            return response()->json($products, 400);
        }else{
            return response()->json($products, 200);
        }
        ;
    }
}
