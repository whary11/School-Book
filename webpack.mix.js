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

// mix.js('resources/js/app.js', 'public/js')
//    .sass('resources/sass/app.scss', 'public/css');

mix.js([
        'node_modules/jquery/dist/jquery.min.js',
        'node_modules/popper.js/dist/umd/popper.min.js',
        'node_modules/bootstrap/dist/js/bootstrap.min.js',
        'node_modules/pace-progress/pace.min.js',
        'node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js',
        'node_modules/@coreui/coreui/dist/js/coreui.min.js',
        'node_modules/chart.js/dist/Chart.min.js',
        'node_modules/@coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js',
        'resources/js/app.js'
        //   'resources/js/coreui/main.js'
    ], 'js/appcolegios.min.js')
    .babel([
        'node_modules/@coreui/icons/css/coreui-icons.min.css',
        'node_modules/flag-icon-css/css/flag-icon.min.css',
        'node_modules/font-awesome/css/font-awesome.min.css',
        'node_modules/simple-line-icons/css/simple-line-icons.css',
        'resources/sass/style.css',
        'resources/sass/pace.min.css',
        'resources/sass/app.scss',

        'resources/sass/themify-icons.css'
        // 'node_modules/themify-icons/themify-icons/',
    ], 'public/css/appcolegios.min.css')
