<?php 

/*
|--------------------------------------------------------------------------
| Role Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Role routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "Web" middleware group. Enjoy building your Role!
|
*/
Route::group([
		'as' => 'admin.'
	]
	, function(){

	Route::get('/', ['as' => 'roles.all', 'uses' => 'RolesController@index']);
        Route::post('/', ['as' => 'roles.all', 'uses' => 'RolesController@executeAction']);

        //Route::get('grid', ['as' => 'roles.grid', 'uses' => 'RolesController@grid']);

        Route::get('create', ['as' => 'role.create', 'uses' => 'RolesController@create']);
        Route::post('create', ['as' => 'role.create', 'uses' => 'RolesController@store']);

        Route::get('{id}', ['as' => 'role.update', 'uses' => 'RolesController@edit']);
        Route::post('{id}', ['as' => 'role.update', 'uses' => 'RolesController@update']);

        Route::delete('{id}', ['as' => 'role.delete', 'uses' => 'RolesController@delete']);
	});

