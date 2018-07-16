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
mix.options({
    processCssUrls: false
});

mix.js('resources/assets/js/app.js', 'public/js').version();
mix.js('resources/assets/js_front/app.js', 'public/js_front').version();
mix.sass('resources/assets/sass/app.scss', 'public/css', {
    outputStyle: mix.inProduction ? 'compressed' : 'expanded'
}).version();