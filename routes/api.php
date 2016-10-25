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

Route::get('/user', function () {
    return response()->json(['message'=>'获取成功']);
})->middleware('auth:api');

Route::group(['prefix' => 'user', 'namespace' => 'Auth'], function (){
    Route::get('register','RegisterController@create');
    Route::get('login','LoginController@login');
});
