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

Route::post('login', 'ConsumerAuthController@login');//登入
Route::post('register', 'ConsumerAuthController@register');//註冊

// JWT 登入後
Route::group(['middleware' => 'jwt'], function () {
    //使用者自主重設密碼
    Route::put('resetPassword', 'ConsumerAuthController@resetPassword');
    //登出
    Route::post('logout', 'ConsumerAuthController@logout');

});
