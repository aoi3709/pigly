const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .css('resources/css/common.css', 'public/css')
    .css('resources/css/login.css', 'public/css')
    .css('resources/css/register.css', 'public/css')
    .css('resources/css/weight_logs_index.css', 'public/css')
    .css('resources/css/weight_logs_create.css', 'public/css')
    .css('resources/css/weight_logs_edit.css', 'public/css')
    .css('resources/css/weight_logs_goal_setting.css', 'public/css')
    .options({
        processCssUrls: false // CSS内のURLパスを処理しない (必要な場合のみ)
    });
