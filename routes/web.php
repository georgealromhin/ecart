<?php

use Illuminate\Support\Facades\Route;

/* ====================[[USER]]==================== */
Route::get('/', 'HomeController@index'); // view

Route::get('cart', 'CartController@index'); // view
Route::get('cart/all', 'CartController@getCart'); // view
Route::get('cart/store/{id}/{qty}', 'CartController@store');
Route::get('total', 'CartController@getTotal');
Route::delete('cart/remove/{id}', 'CartController@remove');

Route::get('checkout', 'CheckoutController@index'); // view
Route::post('order/create', 'OrderController@store');
Route::get('about', function(){ return view('about'); });
Route::get('privacy_policy', function(){ return view('privacy_policy'); });
Route::get('terms_conditions', function(){ return view('terms'); });
Route::get('delivery_information', function(){ return view('delivery_info'); });
Route::get('contact', function(){ return view('contact'); });
Route::post('send_mail', 'ContactController@send_mail');


Route::get('menu/products', 'HomeController@getProducts');



/* ====================[[ADMIN]]==================== */

/* ====================[Auth]==================== */
Route::get('admin', 'Admin\Auth\LoginController@index');//view
Route::post('user/login', 'Admin\Auth\LoginController@login');
Route::get('user/logout', 'Admin\Auth\LogoutController@logout');

/* ====================[Dashboard]==================== */
Route::get('dashboard', 'Admin\DashboardController@index')->middleware('auth'); //view

/* ====================[User Manager]==================== */
Route::get('user_manager', 'Admin\UserManagerController@index')->middleware('auth'); // view
Route::get('users', 'Admin\UserManagerController@show')->middleware('auth');
Route::get('user', 'Admin\UserManagerController@userView')->middleware('auth');
Route::post('user/create', 'Admin\UserManagerController@store')->middleware('auth');
Route::get('user/delete/{user_id}', 'Admin\UserManagerController@destroy')->middleware('auth');

/* ====================[Account Settings]==================== */
Route::get('account', 'Admin\AccountController@index')->middleware('auth'); // view
Route::post('name/update', 'Admin\AccountController@updateName')->middleware('auth');
Route::post('username/update', 'Admin\AccountController@updateUsername')->middleware('auth');
Route::post('password/update', 'Admin\AccountController@updatePassword')->middleware('auth');
Route::post('account/delete', 'Admin\AccountController@deleteAccount')->middleware('auth');

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
Route::get('orders', 'Admin\OrderController@index')->middleware('auth');//view
Route::get('orders/all', 'Admin\OrderController@showOrders')->middleware('auth');
Route::get('order_details/{id}', 'Admin\OrderController@show')->middleware('auth');
Route::delete('order/delete/{id}', 'Admin\OrderController@destroy')->middleware('auth');
Route::put('order_status/update/{status}/{id}', 'Admin\OrderController@updateStatus')->middleware('auth');

/* ====================[Store Settings]==================== */
Route::get('settings', 'Admin\SettingsController@index')->middleware('auth');//view
Route::get('settings/all', 'Admin\SettingsController@showSettings')->middleware('auth');
Route::put('settings/update', 'Admin\SettingsController@updateSettings')->middleware('auth');

/* ====================[Banners]==================== */
Route::get('banners', 'Admin\BannerController@index')->middleware('auth');//view
Route::get('banners/all', 'Admin\BannerController@showBanners')->middleware('auth');
Route::post('banner/create', 'Admin\BannerController@store')->middleware('auth');
Route::delete('banner/delete/{id}', 'Admin\BannerController@destroy')->middleware('auth');

/* ====================[Notifications]==================== */
Route::get('notifications/count', 'Admin\NotificationController@index')->middleware('auth');
Route::get('notification/markAsRead', 'Admin\NotificationController@markAsRead')->middleware('auth');


