<?php namespace Modules\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
		// Subscribe the registered event handler
		//Registering views
	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
		
		$view_paths = config('view.paths');
		$extension_views_path  =  realpath(base_path('modules/Admin/views'));
		config(['view.paths' => array_merge($view_paths,[$extension_views_path])]);
	}

}
