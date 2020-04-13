const mix = require('laravel-mix');

mix.js('resources/js/admin/app.js', 'public/js/admin')
   .sass('resources/sass/admin/app.scss', 'public/css/admin').version([
       'public/css/admin/app.css',
    'public/js/admin/app.js'
]);
