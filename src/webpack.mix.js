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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();
mix.js('node_modules/admin-lte/dist/js/adminlte.js', 'public/js')
    .css('node_modules/admin-lte/dist/css/adminlte.css', 'public/css')
    // .js('node_modules/admin-lte/plugins/datatables/jquery.dataTables.js', 'public/js')
    .css('node_modules/admin-lte/plugins/fontawesome-free/css/all.css', 'public/css');
mix.copy('resources/images', 'public/images')

