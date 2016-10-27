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

Route::get('/user', 'OAuthController@getUserByToken')->middleware('auth:api');
Route::group(['prefix' => '/shopcart', 'middleware' => 'auth:api'],function (){
    Route::get('/create','ShopcartController@create');
    Route::get('/show','ShopcartController@getShopcartByUserId');
});
Route::group(['prefix' => '/address', 'middleare' => 'auth:api'],function (){
    Route::get('/show','AddressController@getAddressByUserId');
    Route::get('/select','AddressController@setAddressByUserId');
});


Route::group(['prefix' => 'user', 'namespace' => 'Auth'], function (){
    Route::get('register','RegisterController@create');
    Route::get('login','LoginController@login');
});
