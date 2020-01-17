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

Route::prefix('/backend')->group(function(){
    Route::get('/', 'HomeController@backend')->name('backend');
    
    Route::resource('/users', 'UsersController');

    Route::resource('/suppliers', 'SupplierController');
    Route::resource('/materials', 'MaterialController');
    Route::resource('/products', 'ProductController');
    Route::resource('/categories', 'CategoryController');

    Route::resource('/orders/purchase', 'Orders\PurchaseOrderController');
    Route::resource('/orders/sales', 'Orders\SaleOrderController');
    Route::resource('/orders/return', 'Orders\ReturnOrderController');
});