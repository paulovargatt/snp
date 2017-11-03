let mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
    .copyDirectory('resources/assets/global','public/global')
    .copyDirectory('resources/assets/layouts','public/layouts');
