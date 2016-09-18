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

Route::get('/user', function (Request $request) {
    return response()->json([
        'status' => 200,
        'info' => auth()->user(),
        'message' => '获取用户信息成功'
    ]);
})->middleware('auth:api');

Route::group(['prefix' => 'api', 'namespace' => 'Auth'], function (){
    Route::get('user/register','RegisterController@create');
    Route::get('user/login','LoginController@login');
});