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

// admin 
Route::get('admin', 'Admin\Auth\LoginController@index');
Route::get('login', 'Admin\Auth\LoginController@login');


Route::get('dashboard', 'Admin\DashboardController@index');


Route::get('categories', 'Admin\CategoryController@show');
