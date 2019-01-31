<?php
use Illuminate\Http\Request;


Route::group(['namespace'=>'Admin', 'middleware' => 'web'],function (){
    Route::get('/','MainController@index');

	Route::get('/index/index','IndexController@index');


    Route::get('/index2','MainController@index2');

    Route::get('/wechat/menu','WechatController@menu');
});
