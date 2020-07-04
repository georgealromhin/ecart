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
Route::post('login', 'Admin\Auth\LoginController@login');
Route::get('logout', 'Admin\Auth\LogoutController@logout');

Route::get('users_manager', 'Admin\UsersManagerController@index');
Route::get('users', 'Admin\UsersManagerController@getUsers');
Route::get('add_user', 'Admin\UsersManagerController@addUserView');
Route::post('add_new_user', 'Admin\UsersManagerController@addUser');
Route::delete('delete_user/{user_id}', 'Admin\UsersManagerController@deleteUser');


Route::get('dashboard', 'Admin\DashboardController@index');


Route::get('categories', 'Admin\CategoryController@show');
