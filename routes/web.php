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
Route::get('/backend', 'HomeController@backend')->name('backend');

Route::resource('/users', 'UsersController');

Route::resource('/suppliers', 'SupplierController');
Route::resource('/materials', 'MaterialController');

Route::resource('/orders/purchase', 'Orders\PurchaseController');
Route::resource('/orders/sales', 'Orders\SalesController');
Route::resource('/orders/return', 'Orders\ReturnController');