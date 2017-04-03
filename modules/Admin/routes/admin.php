<?php 

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "Web" middleware group. Enjoy building your Admin!
|
*/
Route::group([
		'as' => 'admin',
		'middleware' => ['role:admin']
	]
	, function(){

		Route::get('/dashboard', function(){
			//dd(config('view.paths'));
			return view('Admin.index');
		});

	});
