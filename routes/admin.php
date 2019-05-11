<?php
use Illuminate\Http\Request;


Route::group(['namespace'=>'Admin', 'middleware' => 'web'],function (){
    Route::get('/login','AuthController@login');
    Route::post('/to-login','AuthController@toLogin')->name('admin_login');
    Route::get('/logout','AuthController@logout')->name('admin_logout');
    Route::get('/auth/code', function(){
        return json_encode(['img_url'=>Captcha::src()]);
    })->name('admin_auth_code');
});



Route::group(['namespace'=>'Admin', 'middleware' => ['web','admin.auth']],function (){
	Route::get('/','IndexController@index')->name('admin');


    Route::get('/index2','MainController@index2');

    Route::get('/wechat/menu','WechatController@menu');


});
