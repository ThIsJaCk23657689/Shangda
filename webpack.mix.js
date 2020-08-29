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
    .js('resources/js/frontend.js', 'public/js')
    .js('resources/js/welcome/app.js', 'public/js/welcome')
    .copy('resources/js/welcome/plugins.js', 'public/js/welcome')
    .js('resources/js/welcome/slides.js', 'public/js/welcome')
    .js('resources/js/frontend/products/index.js', 'public/js/frontend/products')
    .js('resources/js/frontend/products/show.js', 'public/js/frontend/products')
    .js('resources/js/frontend/announcements/index.js', 'public/js/frontend/announcements')
    .js('resources/js/frontend/announcements/show.js', 'public/js/frontend/announcements')
    .js('resources/js/frontend/consumers/login.js', 'public/js/frontend/consumers')
    .js('resources/js/frontend/consumers/reset.js', 'public/js/frontend/consumers')
    .js('resources/js/frontend/consumers/cart.js', 'public/js/frontend/consumers')
    .js('resources/js/frontend/consumers/sale_orders.js', 'public/js/frontend/consumers')
    .js('resources/js/frontend/consumers/register.js', 'public/js/frontend/consumers')

.sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/welcome/slides.scss', 'public/css/welcome')
    .sass('resources/sass/frontend/index.scss', 'public/css/frontend')
    .sass('resources/sass/frontend/about.scss', 'public/css/frontend')
    .sass('resources/sass/frontend/contact.scss', 'public/css/frontend')
    .sass('resources/sass/frontend/products/index.scss', 'public/css/frontend/products')
    .sass('resources/sass/frontend/products/show.scss', 'public/css/frontend/products')
    .sass('resources/sass/frontend/announcements/index.scss', 'public/css/frontend/announcements')
    .sass('resources/sass/frontend/announcements/show.scss', 'public/css/frontend/announcements')
    .sass('resources/sass/frontend/consumers/login.scss', 'public/css/frontend/consumers')
    .sass('resources/sass/frontend/consumers/reset.scss', 'public/css/frontend/consumers')
    .sass('resources/sass/frontend/consumers/profile.scss', 'public/css/frontend/consumers')
    .sass('resources/sass/frontend/consumers/cart.scss', 'public/css/frontend/consumers')
    .sass('resources/sass/frontend/consumers/sale_orders.scss', 'public/css/frontend/consumers')
    .sass('resources/sass/frontend/consumers/sale_order_details.scss', 'public/css/frontend/consumers')
    .sass('resources/sass/frontend/consumers/register.scss', 'public/css/frontend/consumers')
    .options({
        processCssUrls: false,
    });

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

.js('resources/js/announcements/create.js', 'public/js/announcements')
    .js('resources/js/announcements/edit.js', 'public/js/announcements')

.js('resources/js/information/edit.js', 'public/js/information')

.js('resources/js/reports/sales/year.js', 'public/js/reports/sales')
    .js('resources/js/reports/sales/daily.js', 'public/js/reports/sales')
    .js('resources/js/reports/sales/profit.js', 'public/js/reports/sales')
    .js('resources/js/reports/purchase/daily.js', 'public/js/reports/purchase')
    .js('resources/js/reports/purchase/year.js', 'public/js/reports/purchase')
    .js('resources/js/reports/account/payble_daily.js', 'public/js/reports/account')
    .js('resources/js/reports/account/receivable_daily.js', 'public/js/reports/account')

.sass('resources/sass/backend/backend.scss', 'public/css');