<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/main', 'OrderController@index');
Route::get('main/search', 'OrderController@search');
Route::get('main/createOrder', 'OrderController@createOrder');
Route::get('main/getProducts', 'OrderController@getProducts');
Route::post('main/store', 'OrderController@store');


