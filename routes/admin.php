<?php
use Illuminate\Http\Request;


Route::group(['namespace'=>'Admin', 'middleware' => 'web'],function (){
    Route::get('/login','AuthController@login');
    Route::post('/to-login','AuthController@toLogin')->name('admin_login');
    Route::get('/logout','AuthController@logout')->name('admin_logout');
    Route::get('/auth/code', function(){
        return json_encode(['img_url'=>Captcha::src()]);
    })->name('admin_auth_code');

    Route::post('/cahnge-pwd','AuthController@changePwd')->name('admin_change_pwd')->middleware('admin.auth');
});



Route::group(['namespace'=>'Admin', 'middleware' => ['web','admin.auth']],function (){
    Route::get('/','IndexController@index')->name('admin');
    Route::get('/index-articlec-census','IndexController@articlecCensus');



    Route::get('/wechat/menu','WechatController@menu');
});

/**
 * RbacController 控制器分组
 */
Route::group(['namespace'=>'Admin', 'middleware' => ['web','admin.auth']],function (){
    Route::get('/rbac/admin-page','RbacController@adminMangePage')->name('rbac-admin-page');
    Route::get('/rbac/get-admin-api','RbacController@getAdminApi')->name('rbac-get-admin-api');



    Route::post('/rbac/admin-add-api','RbacController@adminAddApi')->name('rbac-admin-add-api');
    Route::get('/rbac/admin-edit-api','RbacController@adminEditApi')->name('rbac-admin-edit-api');

});