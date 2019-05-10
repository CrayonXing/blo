<?php
use Illuminate\Http\Request;


Route::group(['namespace'=>'Admin', 'middleware' => 'web'],function (){
	Route::get('/','IndexController@index');


    Route::get('/index2','MainController@index2');

    Route::get('/wechat/menu','WechatController@menu');


    Route::get('/login','AuthController@login');

    Route::get('/auth/code', function(){
        return json_encode(['img_url'=>Captcha::src()]);
    })->name('admin_auth_code');
});
