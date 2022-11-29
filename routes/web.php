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
// Home
Route::get('/', 'HomePageController@index');
Route::get('about', 'HomePageController@about');
Route::get('terms', 'HomePageController@terms');
Route::get('faq', 'HomePageController@faq');
Route::get('contact', 'HomePageController@contact');

// Profile
Route::get('/users', 'UsersController@show');
Route::get('/users/edit', 'UsersController@edit');
Route::post('/users/edit', 'UsersController@update')->name('users.edit');


// Cart
Route::get('/cart', 'CartController@show');

// Product
Route::get('/product/{id}', 'ProductController@show');
Route::post('/product/addCart', 'ProductController@addToCart')->name('card.add');
Route::post('/product/removeCart', 'ProductController@removeFromCart')->name('card.remove');
Route::post('/product/clearCart', 'ProductController@clearCart')->name('card.clear');
Route::post('/product/updateCartItem', 'ProductController@updateCart')->name('card.updateItem');


// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('search', 'SearchController@show')->name('search');
