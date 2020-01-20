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
   .js('resources/js/backend.js', 'public/js')
   .js('resources/js/orders/purchase.js', 'public/js/orders')

   .js('resources/js/materials/create.js', 'public/js/materials')
   .js('resources/js/suppliers/create.js', 'public/js/suppliers')
   .js('resources/js/products/create.js', 'public/js/products')
   
   .sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/backend/backend.scss', 'public/css');
