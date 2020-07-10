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

Route::get('/', 'HomeController@index'); // view

Route::get('cart', 'CartController@getCart'); // view
Route::get('cart/store/{id}/{qty}', 'CartController@store');
Route::get('total', 'CartController@getTotal');
Route::get('cart/remove/{id}', 'CartController@remove');


Route::get('checkout', 'CheckoutController@index'); // view
Route::post('order/create', 'OrderController@store');



/* ====================[[ADMIN]]==================== */

/* ====================[Auth]==================== */
Route::get('admin', 'Admin\Auth\LoginController@index');//view
Route::post('user/login', 'Admin\Auth\LoginController@login');
Route::get('user/logout', 'Admin\Auth\LogoutController@logout');

/* ====================[User Manager]==================== */
Route::get('user_manager', 'Admin\UserManagerController@index')->middleware('auth'); // view
Route::get('users', 'Admin\UserManagerController@show')->middleware('auth');
Route::get('user', 'Admin\UserManagerController@userView')->middleware('auth');
Route::post('user/create', 'Admin\UserManagerController@store')->middleware('auth');
Route::get('user/delete/{user_id}', 'Admin\UserManagerController@destroy')->middleware('auth');

/* ====================[Settings]==================== */
Route::get('settings', 'Admin\SettingsController@index')->middleware('auth'); // view
Route::post('name/update', 'Admin\SettingsController@updateName')->middleware('auth');
Route::post('username/update', 'Admin\SettingsController@updateUsername')->middleware('auth');
Route::post('password/update', 'Admin\SettingsController@updatePassword')->middleware('auth');
Route::post('account/delete', 'Admin\SettingsController@deleteAccount')->middleware('auth');

/* ====================[Dashboard]==================== */
Route::get('dashboard', 'Admin\DashboardController@index')->middleware('auth'); //view

/* ====================[Categories]==================== */
Route::get('categories', 'Admin\CategoryController@index')->middleware('auth'); // view
Route::get('categories/all', 'Admin\CategoryController@getCategories')->middleware('auth');
Route::get('category/{id}', 'Admin\CategoryController@getCategory')->middleware('auth');
Route::put('category_status/update/{status}/{id}', 'Admin\CategoryController@updateStatus')->middleware('auth');
Route::post('category/create', 'Admin\CategoryController@store')->middleware('auth');
Route::put('category/update/{id}', 'Admin\CategoryController@update')->middleware('auth');
Route::delete('category/delete/{id}', 'Admin\CategoryController@destroy')->middleware('auth');

/* ====================[Products]==================== */
Route::get('products', 'Admin\ProductController@index')->middleware('auth');// view
Route::get('products/all', 'Admin\ProductController@getProducts')->middleware('auth');
Route::post('product/create', 'Admin\ProductController@stroe')->middleware('auth');
Route::delete('product/delete/{id}', 'Admin\ProductController@destroy')->middleware('auth');
Route::post('product/update', 'Admin\ProductController@update')->middleware('auth');
Route::put('product_status/update/{status}/{id}', 'Admin\ProductController@updateStatus')->middleware('auth');

/* ====================[Orders]==================== */
Route::get('orders', 'Admin\OrderController@index')->middleware('auth');
Route::get('orders/all', 'Admin\OrderController@showOrders')->middleware('auth');
Route::get('order_details/{id}', 'Admin\OrderController@show')->middleware('auth');
Route::delete('order/delete/{id}', 'Admin\OrderController@destroy')->middleware('auth');