<?php
use Illuminate\Http\Request;

/**
 * AuthController 控制器分组
 */
Route::group(['namespace'=>'Admin', 'middleware' => 'web'],function (){
    Route::get('/login','AuthController@login');
    Route::post('/to-login','AuthController@toLogin')->name('admin_login');
    Route::get('/logout','AuthController@logout')->name('admin_logout');
    Route::get('/auth/code', function(){
        return json_encode(['img_url'=>Captcha::src()]);
    })->name('admin_auth_code');

    Route::post('/cahnge-pwd','AuthController@changePwd')->name('admin_change_pwd')->middleware('admin.auth');
    Route::get('/auth/power','AuthController@power')->name('admin_auth_power');
});


/**
 * IndexController 控制器分组
 */
Route::group(['namespace'=>'Admin', 'middleware' => ['web','admin.auth']],function (){
    Route::get('/','IndexController@index')->name('admin');
    Route::get('/index-articlec-census','IndexController@articlecCensus');
});





/**
 * RbacController 控制器分组
 */
Route::group(['namespace'=>'Admin', 'middleware' => ['web','admin.auth']],function (){
    Route::get('/rbac/admin-page','RbacController@adminMangePage')->name('rbac-admin-page')->middleware('admin.rbac');
    Route::get('/rbac/get-admin-api','RbacController@getAdminApi')->name('rbac-get-admin-api');
    Route::post('/rbac/admin-add-api','RbacController@adminAddApi')->name('rbac_create_admin_api')->middleware('admin.rbac');
    Route::post('/rbac/chage-admin-status-api','RbacController@chageAdminStatus')->name('rbac_chage_admin_status')->middleware('admin.rbac');
    Route::post('/rbac/reset-admin-pwd','RbacController@resetAdminPassword')->name('rbac_reset_admin_pwd')->middleware('admin.rbac');
    Route::get('/rbac/give-role-page','RbacController@giveRolePage')->name('rbac_give_role_page');
    Route::post('/rbac/give-role-api','RbacController@giveRoleApi')->name('rbac_give_role_api')->middleware('admin.rbac');

    Route::get('/rbac/role-page','RbacController@roleMangePage')->name('rbac_role_page')->middleware('admin.rbac');
    Route::get('/rbac/get-role-api','RbacController@getRoleApi')->name('rbac_get_role_api');
    Route::post('/rbac/chage-role-status-api','RbacController@chageRoleStatus')->name('rbac_chage_role_status')->middleware('admin.rbac');
    Route::post('/rbac/add-role-api','RbacController@createRoleApi')->name('rbac_create_role_api')->middleware('admin.rbac');

    Route::get('/rbac/permissions-page','RbacController@permissionsMangePage')->name('rbac_permissions_page')->middleware('admin.rbac');
    Route::get('/rbac/give-permissions-page','RbacController@givePermissionsPage')->name('rbac_give_permissions_page');
    Route::post('/rbac/give-permissions-api','RbacController@givePermissionsApi')->name('rbac_give_permissions_api')->middleware('admin.rbac');
    Route::post('/rbac/edit-permissions-api','RbacController@editPermissionsApi')->name('rbac_edit_permissions_api')->middleware('admin.rbac');
});







/**
 * WechatController 控制器分组
 */
Route::group(['namespace'=>'Admin', 'middleware' => ['web','admin.auth']],function (){
    Route::get('/wechat/menu-page','WechatController@menu');

    Route::get('/wechat/wx-conf-page','WechatController@wxConfPage')->name('wx_conf_page')->middleware('admin.rbac');
    Route::post('/wechat/wx-conf-api','WechatController@wxConfApi')->name('wx_conf_api')->middleware('admin.rbac');


    Route::post('/wechat/wx-publish-menu-api','WechatController@publishMenuApi')->name('wx_publis_menu_api')->middleware('admin.rbac');
});
