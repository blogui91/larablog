<?php 

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| Here is where you can register User routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "Aser" middleware group. Enjoy building your User!
|
*/
Route::group([
		'as' => 'admin.'
	]
	, function(){

		Route::get('/testing', function(){
			$user = \Modules\Users\Src\Models\User::find(6);

			$user['created_by_admin'] = true;
			\Event::fire(
				new \Modules\Users\Src\Events\NewUserRequest(  $user ,
					[
						'created_by_admin' => true,
						'pw_temp' => 'bladas'
					]
				)
			);
			//event(new \Modules\Users\Src\Emails\NewUserCreatedByAdmin($user));


		});
		Route::get('/', ['as' => 'users.all', 'uses' => 'UsersController@index']);
        Route::post('/', ['as' => 'users.all', 'uses' => 'UsersController@executeAction']);

        //Route::get('grid', ['as' => 'users.grid', 'uses' => 'UsersController@grid']);

        Route::get('create', ['as' => 'user.create', 'uses' => 'UsersController@create']);
        Route::post('create', ['as' => 'user.create', 'uses' => 'UsersController@store']);

        Route::get('all', function(){
        	return App\User::all();
        });

        Route::get('{id}', ['as' => 'user.update', 'uses' => 'UsersController@edit']);
        Route::post('{id}', ['as' => 'user.update', 'uses' => 'UsersController@update']);
        Route::delete('{id}', ['as' => 'user.delete', 'uses' => 'UsersController@delete']);
	});

