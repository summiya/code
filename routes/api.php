<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Login & Register
Route::post('auth/register', 'AuthController@register');
Route::post('auth/login', 'AuthController@login');

// Routes after user logins
Route::group(['middleware' => 'jwt.auth'], function(){
	// Wishlist Routes
	Route::get('wishlists', 'WishlistController@index');
	Route::get('wishlists/{wishlist}', 'WishlistController@show');
	Route::post('wishlists', 'WishlistController@store');
	Route::put('wishlists/{wishlist}', 'WishlistController@update');
	Route::delete('wishlists/{wishlist}', 'WishlistController@delete');
	Route::post('share_wishlist/{wishlist}', 'WishlistController@share');

	// Wishlist Items Routes
	Route::get('wishlist_items/{wishlist}', 'WishlistItemsController@index');
	Route::delete('wishlist_items/{item}', 'WishlistItemsController@delete');
	Route::post('wishlist_items', 'WishlistItemsController@store');
	Route::get('wishlist_items/item/{item}', 'WishlistItemsController@show');
	Route::put('wishlist_items/{item}', 'WishlistItemsController@update');

	// User Related Routes
  	Route::get('auth/user', 'AuthController@user');
  	Route::get('users', 'AuthController@users');
  	Route::post('auth/logout', 'AuthController@logout');
});

Route::group(['middleware' => 'jwt.refresh'], function(){
	// Token Refreshed Route
  	Route::get('auth/refresh', 'AuthController@refresh');
});