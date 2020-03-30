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

//Route::get('/', function () {
//    return view('welcome');
//});

route::get('/','IndexController@index');
route::get('xiqi','IndexController@xiqi');


// ºóÌ¨µÇÂ¼
Route::prefix('logins')->group(function () {
    Route::any('login','logins\LoginsController@login');
    Route::any('template','logins\LoginsController@template');
    Route::any('get_access_token','logins\LoginsController@get_access_token');
    Route::any('dologin','logins\LoginsController@dologin');
});

