<?php namespace Modules\Tags\Src\Providers;

use Illuminate\Support\ServiceProvider;

use Modules\Tags\Src\Events;
use Modules\Tags\Src\Listeners;


class TagServiceProvider extends ServiceProvider {

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

		$events->listen('Modules\Tags\Src\Events\NewTagRequest','Modules\Tags\Src\Listeners\NewTagResponse');
		
		$events->listen('Modules\Tags\Src\Events\UpdatedTagRequest','Modules\Tags\Src\Listeners\UpdatedTagResponse');

		// Register the validator
		$this->app->bind('Modules\Tags\Src\Validators\TagValidatorInterface', 'Modules\Tags\Src\Validators\TagValidator');

		// Register the repository
		$this->app->bind('Modules\Tags\Src\Repositories\TagRepositoryInterface', 'Modules\Tags\Src\Repositories\TagRepository');


		//Registering views
		$view_paths = config('view.paths');
		$extension_views_path  =  realpath(base_path('modules/Tags/views/'));
		config(['view.paths' => array_merge($view_paths,[$extension_views_path])]);
	}

}
