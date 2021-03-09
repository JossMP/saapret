const mix = require('laravel-mix');

const tailwindcss = require('tailwindcss');

mix.js('resources/js/app.js', 'public/js');

mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts');
//mix.sass('resources/sass/app.scss', 'public/css');
mix.sass('resources/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [tailwindcss('./tailwind.config.js')],
    });
