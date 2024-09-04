<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\UserController@index' );
Route::get('/task/index', 'App\Http\Controllers\TaskController@index' );
Route::get('/task/create', 'App\Http\Controllers\TaskController@create' );
Route::post('/task/store', 'App\Http\Controllers\TaskController@store' );
Route::get('/task/listdata', 'App\Http\Controllers\TaskController@listdata' );
Route::get('/task/edit/{id}', 'App\Http\Controllers\TaskController@edit' );
Route::post('/task/update/{id}', 'App\Http\Controllers\TaskController@update' );
Route::post('/task/delete/{id}', 'App\Http\Controllers\TaskController@delete' );


Route::get('/user/login', 'App\Http\Controllers\UserController@login' );
Route::post('/user/loginIn', 'App\Http\Controllers\UserController@loginIn' );
Route::get('/user/register', 'App\Http\Controllers\UserController@register' );
Route::get('/user/logout', 'App\Http\Controllers\UserController@logout' );
Route::post('/user/registerStore', 'App\Http\Controllers\UserController@registerStore' );
