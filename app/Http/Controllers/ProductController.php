<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\DiscountRequest;

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

    public function forceDelete($id) {
        $this->ProductService->forceDelete($id);
        return redirect()->route('products.index');
    }

    // 顯示此商品對應的折扣資料(有哪些顧客)
    public function showDiscountsPage($id){
        $product = $this->ProductService->getOne($id);
        return view('discounts.edit.product', compact('product'));
    }

    // 編輯商品的折扣資訊
    public function editDiscounts(DiscountRequest $request, $id){
        $product = $this->ProductService->getOne($id);

        // 先將先前的所有折扣商品資料全數刪除
        $product->consumers()->detach();

        // 再新增目前的折扣資料
        foreach($request->discounts as $discount){
            $consumer_id = $discount['consumer_id'];
            $price = $discount['relativePrice'];

            if($price != 0){
                $product->consumers()->attach($consumer_id, [
                    'price' => $price,
                ]);
            }
        }
        return response()->json([
            'status' => 'OK',
            'message' => '成功新增' . count($request->discounts) . '筆折扣資料。',
            'url' => route('discounts.index')
        ]);
    }

    // 取得商品的折扣資料 回傳JSON格式
    public function getDiscountsList($id){
        $product = $this->ProductService->getOne($id);
		$discounts = $product->consumers()
			->select(['id', 'shortName', 'name', 'taxID', 'operator_name_1', 'operator_tel_1'])
			->get();

		return response()->json([
			'status' => 'OK',
            'msg' => '成功取得商品編號' . $id . '的折扣資料。',
            'discounts' => $discounts,
            'retailPrice' => $product->retailPrice
		]);
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
    }
}
