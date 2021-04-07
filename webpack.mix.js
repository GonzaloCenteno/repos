let mix = require('laravel-mix');

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

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');
mix.styles([
		'resources/vendor/css/vendors.min.css',
		'resources/vendor/css/bootstrap.css',
		'resources/vendor/css/bootstrap-extended.css',
		'resources/vendor/css/colors.css',
		'resources/vendor/css/components.css',
		'resources/vendor/css/dark-layout.css',
		'resources/vendor/css/bordered-layout.css',
		'resources/vendor/css/semi-dark-layout.css',
		'resources/vendor/css/vertical-menu.css',
		'resources/vendor/css/dashboard-ecommerce.css',
		'resources/vendor/css/style.css',
	], 'public/css/plantilla.css')
	.js('resources/assets/js/app.js', 'public/js')
	.scripts([
		'resources/vendor/js/vendors.min.js',
		'resources/vendor/js/app-menu.js',
		'resources/vendor/js/app.js',
      	//'resources/vendor/js/dashboard-ecommerce.js',
	], 'public/js/plantilla.js');
