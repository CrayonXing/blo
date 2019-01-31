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

Route::get('/index', 'Admin\\MainController@index');

Route::get('/index2', 'Admin\\MainController@index2');

Route::get('/', function () {
    return view('welcome');
});
