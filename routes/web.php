<?php

/**
 * 主页控制器路由分组
 */
Route::group(['middleware' => []],function (){
    Route::get('/','IndexController@index');
});


/**
 * 授权控制器路由分组
 */
Route::group(['middleware' => []],function (){
    Route::post('/user-login','AuthController@login');
    Route::post('/user-register','AuthController@register');
    Route::get('/user-logout','AuthController@logout')->middleware('web.auth');
});


/**
 * 文章控制器路由分组
 */
Route::group(['middleware' => []],function (){
    Route::get('/article/category/{cid}','ArticleController@category');
    Route::get('/article/details/aid/{aid}','ArticleController@details');
    Route::get('/article/get-comment-list','ArticleController@getCommentList');
    Route::get('/article/search','ArticleController@getArticleList');


    Route::post('/article/comment','ArticleController@comment')->middleware('web.auth');
    Route::post('/article/create','ArticleController@create')->middleware('web.auth');
    Route::get('/article/markdown-editor','ArticleController@markdownEditorPage')->middleware('web.auth');
});

/**
 * 用户中心控制器路由分组
 */
Route::group(['middleware' => ['web.auth']],function (){
    Route::get('/user-main','UserController@index');
    Route::get('/user-article','UserController@article');
    Route::get('/user-pwd','UserController@password');
    Route::post('/user-edit-pwd','UserController@editPassword');
    Route::get('/user-article-list','UserController@getUserArticleList');
    Route::get('/user-datum','UserController@datum');
    Route::post('/user-edit-datum','UserController@datumEdit');
    Route::get('/user-signin','UserController@signin');
    Route::post('/signin','UserController@userSign');
});

/**
 * 上传文件控制器路由分组
 */
Route::group(['middleware' => ['web.auth']],function (){
    Route::post('/upload/upload-img','UploadController@uploadImg');
});