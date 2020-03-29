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
// Route::group(['middleware' => 'jwt'], function () {
//     // 使用者自主重設密碼
//     Route::put('resetPassword', 'Auth\ConsumerAuthController@resetPassword');

//     // 登出
//     Route::post('logout', 'Auth\ConsumerAuthController@logout');
// });
