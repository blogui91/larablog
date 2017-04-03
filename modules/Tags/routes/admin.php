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

	Route::get('/', ['as' => 'tags.all', 'uses' => 'TagsController@index']);
        Route::post('/', ['as' => 'tags.all', 'uses' => 'TagsController@executeAction']);

        //Route::get('grid', ['as' => 'tags.grid', 'uses' => 'TagsController@grid']);

        Route::get('create', ['as' => 'tag.create', 'uses' => 'TagsController@create']);
        Route::post('create', ['as' => 'tag.create', 'uses' => 'TagsController@store']);

        Route::get('{id}', ['as' => 'tag.update', 'uses' => 'TagsController@edit']);
        Route::post('{id}', ['as' => 'tag.update', 'uses' => 'TagsController@update']);

        Route::delete('{id}', ['as' => 'tag.delete', 'uses' => 'TagsController@delete']);
	});

