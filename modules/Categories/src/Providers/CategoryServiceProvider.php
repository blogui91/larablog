<?php namespace Modules\Categories\Src\Providers;

use Illuminate\Support\ServiceProvider;

use Modules\Categories\Src\Events;
use Modules\Categories\Src\Listeners;


class CategoryServiceProvider extends ServiceProvider {

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

		$events->listen('Modules\Categories\Src\Events\NewCategoryRequest','Modules\Categories\Src\Listeners\NewCategoryResponse');
		
		$events->listen('Modules\Categories\Src\Events\UpdatedCategoryRequest','Modules\Categories\Src\Listeners\UpdatedCategoryResponse');

		// Register the validator
		$this->app->bind('Modules\Categories\Src\Validators\CategoryValidatorInterface', 'Modules\Categories\Src\Validators\CategoryValidator');

		// Register the repository
		$this->app->bind('Modules\Categories\Src\Repositories\CategoryRepositoryInterface', 'Modules\Categories\Src\Repositories\CategoryRepository');


		//Registering views
		$view_paths = config('view.paths');
		$extension_views_path  =  realpath(base_path('modules/Categories/views/'));
		config(['view.paths' => array_merge($view_paths,[$extension_views_path])]);
	}

}
