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


// 登录
Route::prefix('logins')->group(function () {
    Route::any('zhuc','logins\LoginsController@zhuc');//注册
    Route::any('dozhuc','logins\LoginsController@dozhuc');//执行注册
    Route::any('login','logins\LoginsController@login');//登录
    Route::any('template','logins\LoginsController@template');
    Route::any('get_access_token','logins\LoginsController@get_access_token');
    Route::any('dologin','logins\LoginsController@dologin');
});

