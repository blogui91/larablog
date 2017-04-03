<?php namespace Modules\Posts\Src\Providers;

use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{

	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
		$events = $this->app['events'];

		// Register the validator
		$this->app->bind('Modules\Posts\Src\Validators\PostValidatorInterface', 'Modules\Posts\Src\Validators\PostValidator');

		// Register the repository
		$this->app->bind('Modules\Posts\Src\Repositories\PostRepositoryInterface', 'Modules\Posts\Src\Repositories\PostRepository');


		// Subscribe the registered event handler
		//Registering views
		$view_paths = config('view.paths');
		$extension_views_path  =  realpath(base_path('modules/Posts/views/'));
		config(['view.paths' => array_merge($view_paths,[$extension_views_path])]);
	}

}
