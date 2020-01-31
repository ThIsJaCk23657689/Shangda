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

// 後臺管理路由
Route::prefix('/backend')->group(function(){
    Route::get('/', 'HomeController@backend')->name('backend');
    
    // 員工管理路由
    Route::resource('/users', 'UsersController');

    // 職稱管理路由
    Route::resource('/jobtitles', 'JobTitleController');

    // 供應商管理路由
    Route::prefix('suppliers')->group(function(){
        Route::get('showName', 'SupplierController@showName')->name('suppliers.showName');
        Route::post('getInfo', 'SupplierController@getInfo')->name('suppliers.getInfo');
    });
    Route::resource('/suppliers', 'SupplierController');

    // 原物料管理路由
    Route::prefix('materials')->group(function(){
        Route::get('showName','MaterialController@showName')->name('materials.showName');
        Route::post('getInfo','MaterialController@getInfo')->name('materials.getInfo');
        
        //基礎原物料管理路由
        Route::prefix('basic')->group(function(){
            Route::get('showName','MaterialController@showName')->name('material.basic.showName');
            Route::post('getInfo','MaterialController@getInfo')->name('material.basic.getInfo');
        });
    });
    Route::resource('/materials', 'MaterialController');

    //商品細項(原物料成分)相關路由
    Route::prefix('/product/details')->group(function(){
        Route::post('store','ProductDetailController@store')->name('products.details.store');
        Route::patch('update','ProductDetailController@update')->name('products.details.update');
        Route::delete('destroy','ProductDetailController@destroy')->name('products.details.destroy');
    });

    // 商品管理路由
    Route::prefix('/products')->group(function(){
        Route::get('showName','ProductController@showName')->name('products.showName');
        Route::post('getInfo','ProductController@getInfo')->name('products.getInfo');
    });
    Route::resource('/products', 'ProductController');

    //商品庫存細項管理路由
    Route::prefix('/produces/details')->group(function(){
        Route::post('store','ProduceController@detailstore')->name('produces.details.store');
        // Route::patch('update','ProduceController@update')->name('productDetail.update');
        // Route::delete('destroy','ProduceController@destroy')->name('productDetail.destroy');
    });
    // 商品庫存管理路由
    Route::resource('/produces', 'ProduceController');

    // 商品類別管理路由
    Route::prefix('/categories')->group(function(){
        Route::get('showName','CategoryController@showName')->name('categories.showName');
        // Route::get('show', 'ProductController@getProductListByCategory')->name('Product.getProductListByCategory');
    });
    Route::resource('/categories', 'CategoryController');

    Route::resource('/consumers', 'ConsumerController');
    
    // 進貨單管理路由
    Route::resource('/orders/purchase', 'Orders\PurchaseOrderController');
    // 進貨單細項資料管理路由
    Route::prefix('/orders/purchase/details')->group(function(){
        Route::post('store', 'Orders\PurchaseOrderDetailController@store')->name('purchase.details.store');
        Route::get('showDetails', 'Orders\PurchaseOrderDetailController@showDetails')->name('purchase.details.showDetails');
        Route::patch('update', 'Orders\PurchaseOrderDetailController@update')->name('purchase.details.update');
        Route::delete('destroy', 'Orders\PurchaseOrderDetailController@destroy')->name('purchase.details.destroy');
    });

    // 銷貨單管理路由
    Route::resource('/orders/sales', 'Orders\SaleOrderController');
    // 銷貨單細項資料管理路由
    Route::prefix('/orders/sales/details')->group(function(){
        
    });

    // 退貨單管理路由
    Route::resource('/orders/return', 'Orders\ReturnOrderController');
    // 退貨單細項資料管理路由
    Route::prefix('/orders/return/details')->group(function(){
        
    });
});
