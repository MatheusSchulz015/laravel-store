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

Route::group(['middleware' => 'auth'],function(){

	Route::get('/method-payment','StoreController@methodPayment')->middleware('check.qty.cart');

Route::post('pagseguro-billet','PagSeguroController@billet');

Route::post('pagseguro-transparente', "PagSeguroController@getCode");
Route::post('pagseguro-lightbox', "PagSeguroController@lightbotxCode");
Route::get('orders', "StoreController@orders");
});

Route::get('/','StoreController@index');
Route::get('/cart','StoreController@cart');
Route::get('/add-to-cart/{id}','Cartcontroller@add');
Route::get('/remove-to-cart/{id}','Cartcontroller@remove');


Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');
