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

Route::get('/test', function(){
    return view('test');
});

Route::get('/', 'HomeController@index')->name('index');
Route::get('/old', 'HomeController@old')->name('old');

Route::get('/products', 'Frontend\ProductController@index')->name('front.products');
Route::post('/products', 'Frontend\ProductController@list');
Route::get('/products/{id}', 'Frontend\ProductController@show')->name('front.products.show');

// 後臺管理路由
Route::prefix('/backend')->group(function(){
    Route::get('/', 'HomeController@backend')->name('backend');

    // 員工管理路由
    Route::resource('/users', 'UsersController');

    // 職稱管理路由
    Route::resource('/jobtitles', 'JobTitleController')->only(['index', 'show']);

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
    });
    Route::resource('/materials', 'MaterialController');

    // 商品管理路由
    Route::prefix('/products')->group(function(){
        Route::get('showName','ProductController@showName')->name('products.showName');
        Route::post('getInfo','ProductController@getInfo')->name('products.getInfo');

        Route::get('{id}/discounts','ProductController@showDiscountsPage')->name('products.showDiscountsPage');
        Route::post('{id}/discounts','ProductController@editDiscounts');
        Route::get('{id}/discounts/list', 'ProductController@getDiscountsList')->name('products.getDiscountsList');
    });
    Route::resource('/products', 'ProductController');

    // 商品庫存細項管理路由
    Route::prefix('/produces/details')->group(function(){
        Route::post('store','ProduceController@detailstore')->name('produces.details.store');
        Route::patch('update','ProduceController@detailupdate')->name('produces.details.update');
        // Route::delete('destroy','ProduceController@destroy')->name('productDetail.destroy');
    });
    // 商品庫存管理路由
    Route::prefix('produces')->group(function(){
        Route::get('{id}/json','ProduceController@getOne')->name('produces.getOne');
    });
    Route::resource('/produces', 'ProduceController');

    // 商品類別管理路由
    Route::prefix('/categories')->group(function(){
        Route::get('showName','CategoryController@showName')->name('categories.showName');
        // Route::get('show', 'ProductController@getProductListByCategory')->name('Product.getProductListByCategory');
    });
    Route::resource('/categories', 'CategoryController')->only(['index', 'show']);;

    // 顧客管理路由
    Route::prefix('/consumers')->group(function(){
        Route::get('showName','ConsumerController@showName')->name('consumers.showName');
        Route::post('getInfo','ConsumerController@getInfo')->name('consumers.getInfo');

        Route::get('taxID/{taxID}/getData','ConsumerController@getDataByTaxID')->name('consumers.getData');

        Route::get('{id}/discounts','ConsumerController@showDiscountsPage')->name('consumers.showDiscountsPage');
        Route::post('{id}/discounts','ConsumerController@editDiscounts');
        Route::get('{id}/discounts/list', 'ConsumerController@getDiscountsList')->name('consumers.getDiscountsList');
    });
    Route::resource('/consumers', 'ConsumerController');

    // 優惠管理路由
    Route::get('/discounts', 'DiscountController@index')->name('discounts.index');

    // 訂單管理路由
    Route::prefix('/orders')->group(function(){

        // 進貨單管理路由
        Route::prefix('/purchase')->group(function(){
            // 確認進貨 -> 寫進log並增加原物料存貨量
            Route::patch('/received', 'Orders\PurchaseOrderController@received')->name('purchase.received');
            Route::patch('/paid', 'Orders\PurchaseOrderController@paid')->name('purchase.paid');

            Route::get('/{id}/json', 'Orders\PurchaseOrderController@getOne')->name('purchase.getOne');

            // 進貨單細項資料管理路由
            Route::prefix('/details')->group(function(){
                Route::post('store', 'Orders\PurchaseOrderDetailController@store')->name('purchase.details.store');
                Route::get('showDetails', 'Orders\PurchaseOrderDetailController@showDetails')->name('purchase.details.showDetails');
                Route::patch('update', 'Orders\PurchaseOrderDetailController@update')->name('purchase.details.update');
                Route::delete('destroy', 'Orders\PurchaseOrderDetailController@destroy')->name('purchase.details.destroy');
            });
        });
        Route::resource('/purchase', 'Orders\PurchaseOrderController');

        // 銷貨單管理路由
        Route::prefix('/sales')->group(function(){
            // 確認出貨及付款 -> 寫進log(商品)
            Route::patch('/delivered', 'Orders\SalesOrderController@delivered')->name('sales.delivered');
            Route::patch('/paid', 'Orders\SalesOrderController@paid')->name('sales.paid');
            Route::patch('/paymentCancel', 'Orders\SalesOrderController@paymentCancel')->name('sales.paymentCancel');
            // // 購物車轉入訂單
            // Route::post('/storeFromCart', 'Orders\SalesOrderController@storeFromCart')->name('sales.storeFromCart');
            Route::get('/{id}/json', 'Orders\SalesOrderController@getOne')->name('sales.getOne');
            // 銷貨單細項資料管理路由
            Route::prefix('/details')->group(function(){
                Route::post('store', 'Orders\SalesOrderDetailController@store')->name('sales.details.store');
                Route::get('showDetails', 'Orders\SalesOrderDetailController@showDetails')->name('sales.details.showDetails');
                Route::patch('update', 'Orders\SalesOrderDetailController@update')->name('sales.details.update');
                Route::delete('destroy', 'Orders\SalesOrderDetailController@destroy')->name('sales.details.destroy');
            });
        });
        Route::resource('/sales', 'Orders\SalesOrderController');

        // 退貨單管理路由
        Route::prefix('/return')->group(function(){
            // 確認退款
            Route::patch('/refundConfirm/{id}', 'Orders\ReturnOrderController@refundConfirm')->name('return.refundConfirm');
            Route::get('/{id}/json', 'Orders\ReturnOrderController@getOne')->name('return.getOne');
            // 退貨單細項資料管理路由
            // Route::prefix('/details')->group(function(){

            // });
        });
        Route::resource('/return', 'Orders\ReturnOrderController');
    });

    //購物車路由
    Route::prefix('/cart')->group(function(){
        // index
        Route::get('/index', 'CartController@index')->name('cart.index');
    });

    // 最新消息路由
    Route::resource('/announcements', 'AnnouncementController');

    // 報表路由
    Route::prefix('/reports')->group(function(){
        // 銷貨年報表、銷貨日報表、銷貨利潤表
        Route::prefix('/sales')->group(function(){
            Route::get('year', 'ReportController@salesReportYearIndex')->name('reports.sales.year');
            Route::post('year', 'ReportController@salesReportYear');

            Route::get('daily', 'ReportController@salesReportDailyIndex')->name('reports.sales.daily');
            Route::post('daily', 'ReportController@salesReportDaily');

            Route::get('profit', 'ReportController@salesReportProfitIndex')->name('reports.sales.profit');
            Route::post('profit', 'ReportController@salesReportProfit');
        });

        // 進貨年報表、進貨日報表
        Route::prefix('/purchase')->group(function(){
            Route::get('year', 'ReportController@purchaseReportYearIndex')->name('reports.purchase.year');
            Route::post('year', 'ReportController@purchaseReportYear');

            Route::get('daily', 'ReportController@purchaseReportDailyIndex')->name('reports.purchase.daily');
            Route::post('daily', 'ReportController@purchaseReportDaily');
        });

        // 帳戶應收、應付報表
        Route::prefix('/account')->group(function(){
            Route::get('payable', 'ReportController@accountReportPayable')->name('reports.account.payable');
            Route::get('receivable', 'ReportController@accountReportReceivable')->name('reports.account.receivable');
        });
    });

});
