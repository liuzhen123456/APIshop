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
//用户登录与注册
Route::prefix('/login')->group(function (){
   Route::get('login','Admin\LoginController@login');
   Route::post('login_do','Admin\LoginController@login_do');
   //注册
   Route::get('reg','Admin\LoginController@reg');
   Route::post('reg_do','Admin\LoginController@reg_do');
});
//个人中心
Route::get('/user/center','Admin\UserController@center')->middleware('islogin');

//测试
Route::get('/test','Admin\LoginController@test');
