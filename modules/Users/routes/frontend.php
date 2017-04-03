<?php
/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| Here is where you can register User routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "user" middleware group. Enjoy building your User!
|
*/

Route::group(['prefix' => 'laravel'], function(){
	Route::get('/', 'UsersController@index');
});


// Route::get('activation/{token}', 'Auth\RegisterController@activateUser')->name('user.activate');
// Route::get('{email}/resend-token', 'Auth\RegisterController@resendEmail')->name('user.resend');

