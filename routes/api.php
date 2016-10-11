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
Route::get('/products', 'ApiController@getProducts');
Route::post('/products', 'ApiController@postProduct');
Route::get('/product/{id}', 'ApiController@getProduct');
Route::post('/uploadfile', 'ApiController@uploadFile');
Route::get('/search_product', 'ApiController@searchProduct');
Route::delete('/delete/{id}', 'ApiController@deleteProduct');

Route::get('/user', function(Request $request) { 
    return response()->json($request->user()); 
});

Route::post('/login', function(Request $request) {
    $data = $request->input();

    if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
        // Authentication passed...
        return response()->json(['status' => 'login success', 'api_token' => $request->user()->api_token]);
    }  

    return response()->json(['status' => 'login failed', 'api_token' => null]);
});
