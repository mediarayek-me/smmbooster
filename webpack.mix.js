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
mix.js('resources/js/pages/service.js', 'public/js/pages')
mix.js('resources/js/pages/order.js', 'public/js/pages')
mix.js('resources/js/pages/category.js', 'public/js/pages')
mix.js('resources/js/pages/api_provider.js', 'public/js/pages')
mix.js('resources/js/pages/user.js', 'public/js/pages')
mix.js('resources/js/pages/admin.js', 'public/js/pages')
mix.js('resources/js/pages/funds.js', 'public/js/pages')
mix.js('resources/js/pages/payment_method.js', 'public/js/pages')
mix.js('resources/js/pages/transaction.js', 'public/js/pages')
mix.js('resources/js/pages/ticket.js', 'public/js/pages')
mix.js('resources/js/pages/faq.js', 'public/js/pages')
mix.js('resources/js/pages/language.js', 'public/js/pages')
mix.js('resources/js/pages/user_notifications.js', 'public/js/pages')
mix.js('resources/js/pages/announcement.js', 'public/js/pages')
mix.js('resources/js/pages/dashboard.js', 'public/js/pages')
mix.js('resources/admin/js/pages/db_analytics.js', 'public/admin/js/pages/db_analytics.min.js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/app-rtl.scss', 'public/css')
    .sass('resources/sass/admin-rtl.scss', 'public/css')
    .sass('resources/admin/scss/main.scss', 'public/admin/css');
