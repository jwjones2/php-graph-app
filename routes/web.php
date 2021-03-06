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

Route::get('/', 'HomeController@welcome');
Route::get('/signin', 'AuthController@signin');
Route::get('/callback', 'AuthController@callback');
Route::get('/signout', 'AuthController@signout');
Route::get('/search/{id}', 'CalendarController@calendar');
Route::get('/test', 'HomeController@test1');
Route::get('/test2', 'HomeController@test2');
Route::resource('searches', 'SearchController');