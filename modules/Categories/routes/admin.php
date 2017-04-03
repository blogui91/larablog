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

	Route::get('/', ['as' => 'categories.all', 'uses' => 'CategoriesController@index']);
        Route::post('/', ['as' => 'categories.all', 'uses' => 'CategoriesController@executeAction']);

        //Route::get('grid', ['as' => 'categorys.grid', 'uses' => 'CategoriesController@grid']);

        Route::get('create', ['as' => 'category.create', 'uses' => 'CategoriesController@create']);
        Route::post('create', ['as' => 'category.create', 'uses' => 'CategoriesController@store']);

        Route::get('{id}', ['as' => 'category.update', 'uses' => 'CategoriesController@edit']);
        Route::post('{id}', ['as' => 'category.update', 'uses' => 'CategoriesController@update']);

        Route::delete('{id}', ['as' => 'category.delete', 'uses' => 'CategoriesController@delete']);
	});

