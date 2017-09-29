const { mix } = require('laravel-mix');
const URL_SCRIPTS = 'resources/assets/js/';
const URL_STYLES = 'resources/assets/sass/';


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

mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/images_sc.js', 'public/js')
    .js('resources/assets/js/bootstrap.js', 'public/js')

   .sass('resources/assets/sass/app.scss', 'public/css');
