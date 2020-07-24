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

// 前台
mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/welcome/app.js', 'public/js/welcome')
    .copy('resources/js/welcome/plugins.js', 'public/js/welcome')
    .js('resources/js/welcome/slides.js', 'public/js/welcome')

.sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/welcome/slides.scss', 'public/css/welcome');

// 後台
mix.js('resources/js/backend.js', 'public/js')

.js('resources/js/users/create.js', 'public/js/users')
    .js('resources/js/suppliers/create.js', 'public/js/suppliers')
    .js('resources/js/materials/create.js', 'public/js/materials')

.js('resources/js/orders/purchase/index.js', 'public/js/orders/purchase')
    .js('resources/js/orders/purchase/create.js', 'public/js/orders/purchase')
    .js('resources/js/orders/purchase/edit.js', 'public/js/orders/purchase')

.js('resources/js/orders/sales/index.js', 'public/js/orders/sales')
    .js('resources/js/orders/sales/create.js', 'public/js/orders/sales')
    .js('resources/js/orders/sales/edit.js', 'public/js/orders/sales')
    .js('resources/js/orders/returns/create.js', 'public/js/orders/returns')
    .js('resources/js/orders/returns/edit.js', 'public/js/orders/returns')

.js('resources/js/consumers/create.js', 'public/js/consumers')

.js('resources/js/discounts/index.js', 'public/js/discounts')
    .js('resources/js/discounts/edit-consumer.js', 'public/js/discounts')
    .js('resources/js/discounts/edit-product.js', 'public/js/discounts')


.js('resources/js/products/create.js', 'public/js/products')
    .js('resources/js/produces/create.js', 'public/js/produces')
    .js('resources/js/produces/edit.js', 'public/js/produces')

.js('resources/js/reports/sales/year.js', 'public/js/reports/sales')

.sass('resources/sass/backend/backend.scss', 'public/css');