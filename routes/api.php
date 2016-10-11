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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/products', 'ApiController@getProducts');
Route::post('/products', 'ApiController@postProduct');
Route::get('/product/{id}', 'ApiController@getProduct');
Route::post('/uploadfile', 'ApiController@uploadFile');
Route::get('/search_product', 'ApiController@searchProduct');
Route::delete('/delete/{id}', 'ApiController@deleteProduct');

Route::get('/user', 'ApiController@getUser');
