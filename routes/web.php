<?php

use Illuminate\Http\Request;
use App\User;
 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/', 'HomeController@getIndex');
Route::get('/login', function() {
    return view('auth.login');
});

Route::get('/register', function() {
    return view('auth.register');
});

Route::post('/login', function(Request $request) {
    $data = $request->input();

    if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
        // Authentication passed...
        return redirect()->intended('/');
    }  
});

Route::post('/register', function(Request $request) {
    $data = $request->input();
    $user = new User;
    $user->name = $data['name'];
    $user->email = $data['email'];
    $user->password = bcrypt($data['password']);
    //this changes when you have the create an organisation screen. 
    $user->company_id = 1;
    $user->save();
});
