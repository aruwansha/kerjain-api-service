<?php
use Illuminate\Support\Facades\Route;

// Authentication User
Route::post('auth/register', 'AuthController@register');
Route::post('auth/login', 'AuthController@login');

//Seller
Route::put('seller/update/{seller}', 'SellerController@updateProfile')->middleware('auth:api');
Route::get('seller/product', 'SellerController@getProductList')->middleware('auth:api');
Route::post('seller/product/add', 'SellerController@addProduct')->middleware('auth:api');
Route::put('seller/product/update/{product}', 'SellerController@updateProduct')->middleware('auth:api');
Route::delete('seller/product/delete/{product}', 'SellerController@deleteProduct')->middleware('auth:api');

//Buyer
Route::put('buyer/update/{buyer}', 'BuyerController@update')->middleware('auth:api');
