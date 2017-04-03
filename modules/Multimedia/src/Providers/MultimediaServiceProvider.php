<?php namespace Modules\Multimedia\Src\Providers;

use Illuminate\Support\ServiceProvider;

class MultimediaServiceProvider extends ServiceProvider {

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
		$this->app->bind('Modules\Multimedia\Src\Validators\MultimediaValidatorInterface', 'Modules\Multimedia\Src\Validators\MultimediaValidator');

		// Register the repository
		$this->app->bind('Modules\Multimedia\Src\Repositories\MultimediaRepositoryInterface', 'Modules\Multimedia\Src\Repositories\MultimediaRepository');


		// Subscribe the registered event handler
		//Registering views
		$view_paths = config('view.paths');
		$extension_views_path  =  realpath(base_path('modules/Multimedia/views/'));
		config(['view.paths' => array_merge($view_paths,[$extension_views_path])]);
	}

}
