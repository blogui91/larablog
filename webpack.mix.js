const {
	mix
} = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.sass('resources/assets/frontend/sass/app.scss', 'public/frontend/css/app.css');
mix.sass('resources/assets/admin/sass/app.scss', 'public/admin/css/app.css');

mix
	.js('resources/assets/frontend/js/app.js', 'public/frontend/js') //Frontend
	.js('resources/assets/admin/js/app.js', 'public/admin/js/app.js') //Admin

.extract(['vue', 'vuex', 'jquery', 'axios'], 'libs/vendors.js')