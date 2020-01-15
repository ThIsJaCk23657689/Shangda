<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('showName', 'SupplierController@showName')->name('api.supplier.showName');
Route::post('getInfo', 'SupplierController@getInfo')->name('api.supplier.getInfo');
Route::get('showName','MaterialController@showName')->name('api.material.getInfo');
Route::post('getInfo','MaterialController@getInfo')->name('api.material.getInfo');

//新增刪除修改查詢訂單細項資料。
Route::post('store','PurchaseOrderDetailController@store')->name('api.PurchaseOrderDetail.store');
Route::get('showDetails','PurchaseOrderDetailController@showDetails')->name('api.PurchaseOrderDetail.showDetails');
Route::patch('update','PurchaseOrderDetailController@update')->name('api.PurchaseOrderDetail.update');
Route::delete('destroy','PurchaseOrderDetailController@destroy')->name('api.PurchaseOrderDetail.destroy');



