<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return 'called';
    return view('welcome');
});

Auth::routes();
Route::get('/auth/callback','OAuthController@oauth');
Route::group(['prefix' => 'app'], function (){
    //获取首页数据信息
    Route::get('home','IndexController@home');
    //获取所有分类列表信息
    Route::get('category','IndexController@category');
    //根据商品id获取详细信息
    Route::get('goods/{id}','IndexController@getGoodsInfoById')->where('id','[0-9]+');
    //根据分类id获取该分类下所有商品信息
    Route::get('category/{id}/goods','IndexController@getCategoryGoods')->where('id','[0-9]+');
});
/**后台管理**/
Route::group(['prefix' => 'shop' , 'namespace' => 'ShopManage'],  function (){
    Route::get('/{id}','ShopController@index');
    Route::group(['prefix' => 'category'],function (){
        Route::get('/create','ShopController@createCategory')->name('category.create');
        Route::get('/subCategory','ShopController@getSubCategory');
        Route::post('','ShopController@storeCategory')->name('category.store');
        Route::get('/{id}/edit','ShopController@editCategory')->name('category.edit');
        Route::patch('','ShopController@updateCategory')->name('category.update');
        Route::delete('/{id}','ShopController@destroyCategory')->name('category.delete');
    });
    Route::group(['prefix' => 'property'],function (){
        Route::get('/create','ShopController@createProperty')->name('property.create');
        Route::post('','ShopController@storeProperty')->name('property.store');
        Route::get('/list','ShopController@showProperty')->name('property.list');
        Route::get('/{id}/delete','ShopController@destroyProperty')->where('id','[0-9]+')->name('property.delete');
    });
    Route::group(['prefix' => 'goods'],function (){
        Route::get('category_id/{id}/create','CommodityController@create')->where('id','[0-9]+')->name('goods.create');
        Route::get('category_id/{id}','CommodityController@index')->where('id','[0-9]+')->name('goods.list');
        Route::post('','CommodityController@store')->name('goods.store');
        Route::get('{id}/edit','CommodityController@edit')->where('id','[0-9]+')->name('goods.edit');
        Route::patch('{id}','CommodityController@update')->where('id','[0-9]+')->name('goods.update');
        Route::get('{id}/property/create','CommodityController@createProperty')->where('id','[0-9]+')->name('goods.property');
        Route::post('{id}/property','CommodityController@storeProperty')->where('id','[0-9]+')->name('goods.property.store');
    });
});

//测试用
Route::get('/test',function (){

});

Auth::routes();

Route::get('/home', 'HomeController@index');
