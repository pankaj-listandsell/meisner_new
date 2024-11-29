const mix = require('laravel-mix');

mix.js('resources/jsBundler/frontend/clearing_out_form.js', 'public/dist/frontend/js').vue();
mix.js('resources/jsBundler/frontend/crime_cleaning_form.js', 'public/dist/frontend/js').vue();
mix.js('resources/jsBundler/frontend/painting_form.js', 'public/dist/frontend/js').vue();
mix.js('resources/jsBundler/frontend/mover_form.js', 'public/dist/frontend/js').vue();

