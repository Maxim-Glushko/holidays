const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .copy('node_modules/jquery/dist/jquery.min.js', 'public/js/jquery.min.js')
    .js('node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'public/js')
    .sass('node_modules/bootstrap/scss/bootstrap.scss', 'public/css');
