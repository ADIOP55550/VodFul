const mix = require('laravel-mix');
const MixGlob = require('laravel-mix-glob');
const mixGlob = new MixGlob({mix}); // mix is required
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


mixGlob.js('resources/js/app.js', 'public/js')
    .sass('resources/css/app.scss', 'public/css', [
        //
    ])
    .js('resources/js/homepage/*.js', 'public/js/homepage')
;
