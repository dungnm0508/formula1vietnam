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

Route::get('/', function () {
    return view('welcome');
});
Route::get('cron',['as'=>'cronData','uses'=>'AppController@cronData']);

Route::get('getData',['as'=>'getData','uses'=>'AppController@getDataCalendar']);

Route::get('info',['as'=>'getDataInfo','uses'=>'AppController@getDataInfo']);

