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
Route::get('/deleteUser', 'UsersController@deleteuser')->name('deleteUser');


// Cart
Route::get('/cart', 'CartController@show');
Route::post('/add-to-cart', 'CartController@addProduct')->name('add-to-cart');
Route::post('/delete-cart-item', 'CartController@delProduct');
Route::post('/update-cart', 'CartController@updatecart');
Route::get('/load-cart-data' , 'CartController@cartcount');

//wishlist
Route::get('wishlist', 'WishListController@wishlist')->name('wishlist');
Route::post('/update_wishlist', 'WishListController@updateWishlist');
Route::post('/remove_wishlist', 'WishListController@removeWishlist');


// Product
Route::get('/product/{id}', 'ProductController@show');
Route::post('/product/addProduct', 'ProductController@addToDB')->name('product.add');

// Category
Route::get('/category', 'CategoryController@show');
Route::get('/category/{id}', 'CategoryController@products');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

//search
Route::get('search', 'SearchController@show')->name('search');

//checkout
Route::get('checkout', 'CheckoutController@index')->name('checkout');

//orders
Route::post('place-order','CheckoutController@placeorder')->name('place-order');
Route::get('orders','CheckoutController@showorders')->name('orders');
Route::get('view-order/{id}','CheckoutController@vieworder')->name('view-order');

//reviews
Route::post('addreview','ReviewController@addreview')->name('addreview');


