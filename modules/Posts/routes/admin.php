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

	Route::get('/', ['as' => 'posts.all', 'uses' => 'PostsController@index']);

        Route::post('/', ['as' => 'posts.all', 'uses' => 'PostsController@store']);

        Route::get('grid', ['as' => 'posts.grid', 'uses' => 'PostsController@grid']);

        Route::get('create', ['as' => 'post.create', 'uses' => 'PostsController@create']);
        Route::post('create', ['as' => 'post.create', 'uses' => 'PostsController@store']);

        Route::get('{id}', ['as' => 'post.update', 'uses' => 'PostsController@edit']);
        Route::post('{id}', ['as' => 'post.update', 'uses' => 'PostsController@update']);

        Route::delete('{id}', ['as' => 'post.delete', 'uses' => 'PostsController@delete']);
	});

