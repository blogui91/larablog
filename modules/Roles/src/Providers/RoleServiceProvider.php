<?php namespace Modules\Roles\Src\Providers;

use Illuminate\Support\ServiceProvider;

use Modules\Roles\Src\Events;
use Modules\Roles\Src\Listeners;


class RoleServiceProvider extends ServiceProvider {

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

		$events->listen('Modules\Roles\Src\Events\NewRoleRequest','Modules\Roles\Src\Listeners\NewRoleResponse');
		
		$events->listen('Modules\Roles\Src\Events\UpdatedRoleRequest','Modules\Roles\Src\Listeners\UpdatedRoleResponse');

		// Register the validator
		$this->app->bind('Modules\Roles\Src\Validators\RoleValidatorInterface', 'Modules\Roles\Src\Validators\RoleValidator');

		// Register the repository
		$this->app->bind('Modules\Roles\Src\Repositories\RoleRepositoryInterface', 'Modules\Roles\Src\Repositories\RoleRepository');


		//Registering views
		$view_paths = config('view.paths');
		$extension_views_path  =  realpath(base_path('modules/Roles/views/'));
		config(['view.paths' => array_merge($view_paths,[$extension_views_path])]);
	}

}
