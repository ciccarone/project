// webpack.mix.js

const mix = require('laravel-mix');

mix.sass('resources/css/custom.scss', 'public/css')
   .postCss('resources/css/app.css', 'public/css', [
       require('tailwindcss'),
   ]);
