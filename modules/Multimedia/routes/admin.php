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

	Route::get('/', ['as' => 'multimedias.all', 'uses' => 'MultimediaController@index']);
        Route::post('/', ['as' => 'multimedias.all', 'uses' => 'MultimediaController@executeAction']);

        Route::get('grid', ['as' => 'multimedias.grid', 'uses' => 'MultimediaController@grid']);

        Route::get('create', ['as' => 'multimedia.create', 'uses' => 'MultimediaController@create']);
        Route::post('create', ['as' => 'multimedia.create', 'uses' => 'MultimediaController@store']);

        Route::post('create-multiple', ['as' => 'multimedia.create-multiple', 'uses' => 'MultimediaController@storeMultiple']);


        Route::get('{id}', ['as' => 'multimedia.update', 'uses' => 'MultimediaController@edit']);
        Route::post('{id}', ['as' => 'multimedia.update', 'uses' => 'MultimediaController@update']);

        Route::delete('{id}', ['as' => 'multimedia.delete', 'uses' => 'MultimediaController@delete']);
	});

