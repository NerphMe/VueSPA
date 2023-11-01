const mix = require('laravel-mix');
require('laravel-mix-vue3');
const path = require('path');

mix.js('resources/js/app.js', 'public/js')
    .vue({ version: 3 })
    .postCss('resources/css/app.css', 'public/css', [
    ]);

mix.webpackConfig({
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './resources/js/'),
        },
        extensions: ['.wasm', '.mjs', '.js', '.jsx', '.json', '.vue', '.ts', '.tsx'],
    },
})
