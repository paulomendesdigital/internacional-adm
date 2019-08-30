const mix = require('laravel-mix');

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

mix.js('resources/js/bootstrap.js', 'public/js/bootstrap.js')
    .js('resources/js/abrangencia/app.js', 'public/js/abrangencia.js')
    .js('resources/js/panel-client-abrangencia/app.js', 'public/js/panel-client-abrangencia.js')
    .js('resources/js/sales-center/app.js', 'public/js/sales-center.js')
    .js('resources/js/site-abrangencia/app.js', 'public/js/site-abrangencia.js')
    .js('resources/js/site-dependents/app.js', 'public/js/site-dependents.js')
    .sass('resources/sass/app.scss', 'public/css')
    .extract(['vue']);
