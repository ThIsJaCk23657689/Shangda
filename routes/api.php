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

Route::post('login', 'Auth\Consumer\LoginController@login')->name('consumer.login');
Route::post('logout', 'Auth\Consumer\LoginController@logout')->name('consumer.logout');
Route::post('register', 'Auth\Consumer\RegisterController@register')->name('consumer.register');

// // JWT 登入後
Route::group(['middleware' => 'jwt'], function () {
    // // 使用者自主重設密碼
    // Route::put('resetPassword', 'Auth\ConsumerAuthController@resetPassword');

    // // 登出
    // Route::post('logout', 'Auth\ConsumerAuthController@logout');

    // 購物車相關
    Route::post('clearCartDetails', 'CartController@clearCartDetails')->name('cart.clearCartDetails');
    Route::get('getCartDetail', 'CartDetailController@getCartDetail')->name('cart.getCartDetail');
    Route::get('getCartDetailsByCartId', 'CartDetailController@getCartDetailsByCartId')->name('cart.getCartDetailsByCartId');
    Route::get('getCartDetailsByConsumerId', 'CartDetailController@getCartDetailsByConsumerId')->name('cart.getCartDetailsByConsumerId');
    Route::get('getCartDetailsByToken', 'CartDetailController@getCartDetailsByToken')->name('cart.getCartDetailsByToken');
    Route::post('add', 'CartDetailController@add')->name('cart.add');
    Route::patch('update', 'CartDetailController@update')->name('cart.update');
    Route::delete('destroy', 'CartDetailController@destroy')->name('cart.destroy');

    // 購物車轉入訂單
    Route::post('/storeFromCart', 'Orders\SalesOrderController@storeFromCart')->name('sales.storeFromCart');
});
