<?php
/*
|--------------------------------------------------------------------------
| Roles Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Role routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "web" middleware group. Enjoy building your Role!
|
*/

Route::group(['prefix' => 'laravel'], function(){
	Route::get('/', 'CategoriesController@index');
});

