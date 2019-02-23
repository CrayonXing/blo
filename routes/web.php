<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::group(['namespace'=>'Web'],function (){
    Route::get('/','IndexController@index');


    Route::get('/article/category/{type}','ArticleController@category');
    Route::get('/article/details/aid/{aid}','ArticleController@details');


    Route::post('/article/create','ArticleController@create');
    Route::get('/article/edit','ArticleController@edit');
    Route::post('/article/uploadFile','ArticleController@uploadFile');
    Route::get('/article/search','ArticleController@getArticleList');




    Route::post('/user-login','AuthController@login');
    Route::post('/user-register','AuthController@register');
	Route::get('/user-logout','AuthController@logout');


    //user  控制器
    Route::get('/user-main','UserController@index');
    Route::get('/user-article','UserController@article');
    Route::get('/user-pwd','UserController@password');
    Route::post('/user-edit-pwd','UserController@editPassword');
});
