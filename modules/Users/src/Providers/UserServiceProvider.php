<?php namespace Modules\Users\Src\Providers;

use Illuminate\Support\ServiceProvider;

use Modules\Users\Src\Events;
use Modules\Users\Src\Listeners;


class UserServiceProvider extends ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
		// Subscribe the registered event handler

	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
		$events = $this->app['events'];

		$events->listen('Modules\Users\Src\Events\NewUserRequest','Modules\Users\Src\Listeners\NewUserResponse');
		
		$events->listen('Modules\Users\Src\Events\UpdatedUserRequest','Modules\Users\Src\Listeners\UpdatedUserResponse');

		// Register the validator
		$this->app->bind('Modules\Users\Src\Validators\UserValidatorInterface', 'Modules\Users\Src\Validators\UserValidator');

		// Register the repository
		$this->app->bind('Modules\Users\Src\Repositories\UserRepositoryInterface', 'Modules\Users\Src\Repositories\UserRepository');


		//Registering views
		$view_paths = config('view.paths');
		$extension_views_path  =  realpath(base_path('modules/Users/views/'));
		config(['view.paths' => array_merge($view_paths,[$extension_views_path])]);
	}

}
