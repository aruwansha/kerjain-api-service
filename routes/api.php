<?php
use Illuminate\Support\Facades\Route;

// Authentication User
Route::post('auth/register', 'AuthController@register');
Route::post('auth/login', 'AuthController@login');

//Seller
Route::put('seller/update/{seller}', 'SellerController@update')->middleware('auth:api');
Route::post('seller/product/add', 'ProductController@add')->middleware('auth:api');
Route::put('seller/product/update', 'ProductController@update')->middleware('auth:api');
Route::delete('seller/product/delete', 'ProductController@delete')->middleware('auth:api');

//Buyer
Route::put('buyer/update/{buyer}', 'BuyerController@update')->middleware('auth:api');
