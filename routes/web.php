<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('index');

Route::prefix('/resource')->group(function(){
    Route::get('/', 'HomeController@backend')->name('backend');
    
    Route::resource('/users', 'UsersController');

    Route::resource('/suppliers', 'SupplierController');
    Route::resource('/materials', 'MaterialController');
    Route::resource('/products', 'ProductController');

    Route::resource('/orders/purchase', 'Orders\PurchaseOrderController');
    Route::resource('/orders/sales', 'Orders\SaleOrderController');
    Route::resource('/orders/return', 'Orders\ReturnOrderController');
});


Route::prefix('/api')->group(function(){
    Route::get('showName', 'SupplierController@showName')->name('api.supplier.showName');
    Route::post('getInfo', 'SupplierController@getInfo')->name('api.supplier.getInfo');
});

Route::prefix('material')->group(function(){
    Route::get('showName','MaterialController@showName')->name('api.material.showName');
    Route::post('getInfo','MaterialController@getInfo')->name('api.material.getInfo');
});

//新增刪除修改查詢訂單細項資料。
Route::post('store', 'Orders\PurchaseOrderDetailController@store')->name('api.PurchaseOrderDetail.store');
Route::get('showDetails', 'Orders\PurchaseOrderDetailController@showDetails')->name('api.PurchaseOrderDetail.showDetails');
Route::patch('update', 'Orders\PurchaseOrderDetailController@update')->name('api.PurchaseOrderDetail.update');
Route::delete('destroy', 'Orders\PurchaseOrderDetailController@destroy')->name('api.PurchaseOrderDetail.destroy');


//修改顯示基礎原物料價格(會影響商品總價)
Route::get('show', 'BasicMaterialController@show')->name('api.BasicMaterial.show');
Route::patch('update', 'BasicMaterialController@update')->name('api.BasicMaterial.update');

//get product list by category_id
Route::get('show', 'ProductController@getProductListByCategory')->name('api.Product.getProductListByCategory');

//取得所有類別名稱與id
Route::prefix('material')->group(function(){
    Route::get('showName','CategoryController@showName')->name('api.category.showName');
});
