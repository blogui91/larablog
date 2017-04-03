<?php namespace Modules;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RoutesServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */

    protected $namespace_modules = [
    	'users' => [
    		'frontend' => 'Modules\Users\Src\Controllers\Frontend',
    		'admin' => 'Modules\Users\Src\Controllers\Admin',
    	],
        'roles' => [
            'frontend' => 'Modules\Roles\Src\Controllers\Frontend',
            'admin' => 'Modules\Roles\Src\Controllers\Admin',
        ],
        'admin' => [
            'admin' => 'Modules\Admin\Src\Controllers\Admin',
        ],
        'multimedias' => [
            'frontend' => 'Modules\Multimedia\Src\Controllers\Frontend',
            'admin' => 'Modules\Multimedia\Src\Controllers\Admin'
        ],
        'posts' => [
            'frontend' => 'Modules\Posts\Src\Controllers\Frontend',
            'admin' => 'Modules\Posts\Src\Controllers\Admin'
        ],

        'categories' => [
            'frontend' => 'Modules\Categories\Src\Controllers\Frontend',
            'admin' => 'Modules\Categories\Src\Controllers\Admin'
        ],

        'tags' => [
            'frontend' => 'Modules\Tags\Src\Controllers\Frontend',
            'admin' => 'Modules\Tags\Src\Controllers\Admin'
        ],

    	'new_module' => [
    		'frontend' => '',
    		'adin' => ''
    	]
    ];

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapAdminRoutes();
        $this->mapUsersRoutes();
        $this->mapRolesRoutes();
        $this->mapMultimediaRoutes();
        $this->mapPostsRoutes();
        $this->mapCategoriesRoutes();
        $this->mapTagsRoutes();




    }

      /**
     * Define the "admin" routes for the application.
     *
     * These routes are only for admin.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        $module = 'admin';

        //Admin
        Route::prefix($module)
             ->middleware('web')
             ->namespace($this->namespace_modules[$module]['admin'])
             ->group(base_path('Modules/Admin/routes/admin.php'));

    }

    /**
     * Define the "admin" routes for the application.
     *
     * These routes are only for admin.
     *
     * @return void
     */
    protected function mapUsersRoutes()
    {
    	$module = 'users';

    	//Frontend
        Route::prefix('users')
             ->middleware('web')
             ->namespace($this->namespace_modules[$module]['frontend'])
             ->group(base_path('Modules/Users/routes/frontend.php'));

        //Admin
        Route::prefix('admin/users')
             ->middleware('web')
             ->namespace($this->namespace_modules[$module]['admin'])
             ->group(base_path('Modules/Users/routes/admin.php'));
    }

    /**
     * Define the "admin" routes for the application.
     *
     * These routes are only for admin.
     *
     * @return void
     */
    protected function mapRolesRoutes()
    {
        $module = 'roles';

        //Frontend
        Route::prefix('roles')
             ->middleware('web')
             ->namespace($this->namespace_modules[$module]['frontend'])
             ->group(base_path('Modules/Roles/routes/frontend.php'));

        //Admin
        Route::prefix('admin/roles')
             ->middleware('web')
             ->namespace($this->namespace_modules[$module]['admin'])
             ->group(base_path('Modules/Roles/routes/admin.php'));
    }

    /**
     * Define the "Multimedia" routes for the application.
     *
     * These routes are only for admin.
     *
     * @return void
     */
    protected function mapMultimediaRoutes()
    {
        $module = 'multimedias';

        //Frontend
        Route::prefix('multimedias')
             ->middleware('web')
             ->namespace($this->namespace_modules[$module]['frontend'])
             ->group(base_path('Modules/Multimedia/routes/frontend.php'));

        //Admin
        Route::prefix('admin/multimedias')
             ->middleware('web')
             ->namespace($this->namespace_modules[$module]['admin'])
             ->group(base_path('Modules/Multimedia/routes/admin.php'));
    }

    /**
     * Define the "Posts" routes for the application.
     *
     * These routes are only for admin.
     *
     * @return void
     */
    protected function mapPostsRoutes()
    {
        $module = 'posts';

        //Frontend
        Route::prefix('posts')
             ->middleware('web')
             ->namespace($this->namespace_modules[$module]['frontend'])
             ->group(base_path('Modules/Posts/routes/frontend.php'));

        //Admin
        Route::prefix('admin/posts')
             ->middleware('web')
             ->namespace($this->namespace_modules[$module]['admin'])
             ->group(base_path('Modules/Posts/routes/admin.php'));
    }


    /**
     * Define the "Categories" routes for the application.
     *
     * These routes are only for admin.
     *
     * @return void
     */
    protected function mapCategoriesRoutes()
    {
        $module = 'categories';

        //Frontend
        Route::prefix('categories')
             ->middleware('web')
             ->namespace($this->namespace_modules[$module]['frontend'])
             ->group(base_path('Modules/Categories/routes/frontend.php'));

        //Admin
        Route::prefix('admin/categories')
             ->middleware('web')
             ->namespace($this->namespace_modules[$module]['admin'])
             ->group(base_path('Modules/Categories/routes/admin.php'));
    }



    /**
     * Define the "Tags" routes for the application.
     *
     * These routes are only for admin.
     *
     * @return void
     */
    protected function mapTagsRoutes()
    {
        $module = 'tags';

        //Frontend
        Route::prefix('tags')
             ->middleware('web')
             ->namespace($this->namespace_modules[$module]['frontend'])
             ->group(base_path('Modules/Tags/routes/frontend.php'));

        //Admin
        Route::prefix('admin/tags')
             ->middleware('web')
             ->namespace($this->namespace_modules[$module]['admin'])
             ->group(base_path('Modules/Tags/routes/admin.php'));
    }
}
