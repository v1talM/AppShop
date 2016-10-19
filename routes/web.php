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
    Route::get('home','HomeController@index');
    Route::get('category','HomeController@category');
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
   $good = \App\StoreManage\Goods::find(2);
   $types = $good->types()->get()->toArray();
   $prop = new \App\StoreManage\Type($types);
    dd($prop->with('properties')->get());
});