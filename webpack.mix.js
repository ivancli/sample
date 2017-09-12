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

mix.js([
    'resources/assets/js/app.js',
    'node_modules/jquery-ui/ui/widgets/datepicker.js',
    'resources/assets/js/vendors/jquery.validate.min.js',
    'node_modules/bootstrap-select/dist/js/bootstrap-select.js'
], 'public/js/vendors.js')
    .js([
        'resources/assets/js/vendors/jquery.bootstrap.wizard.js',
        'resources/assets/js/components/ConciergeWizard.js',
    ], 'public/js/concierge.js')
    .js([
        'resources/assets/js/main.js',
        'resources/assets/js/burger-navigation.js'
    ], 'public/js/main.js')
    .styles([
        'resources/assets/css/vendors/bootstrap.min.css',
        'resources/assets/css/vendors/bootstrap-theme.min.css',
        'resources/assets/css/vendors/font-awesome.min.css',
        'node_modules/jquery-ui/themes/base/datepicker.css',
        'node_modules/bootstrap-select/dist/css/bootstrap-select.css',
        'resources/assets/css/vendors/iconmoon.css'
    ], 'public/css/vendors.css')
    .styles([
        'resources/assets/css/vendors/gsdk-bootstrap-wizard.css'
    ], 'public/css/concierge.css')
    .styles([
        'resources/assets/css/main.css',
        'resources/assets/css/components/burger-navigation.css',
        'resources/assets/css/components/forms.css',
        'resources/assets/css/components/row-media.css',
        'resources/assets/css/components/card-media.css',
        'resources/assets/css/utility.css'
    ], 'public/css/main.css')
    .styles([
        'resources/assets/css/belrose.css'
    ], 'public/css/belrose.css');

mix.copy('resources/assets/js/jquery.mask.js', 'public/js/jquery.mask.js');

mix.copyDirectory('resources/assets/fonts', 'public/fonts');
