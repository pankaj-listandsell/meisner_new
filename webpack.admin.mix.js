const mix = require('laravel-mix');

// Admin
// mix.webpackConfig({
//     output: {
//         path:__dirname+'/public/dist/admin',
//     }
// });


mix.setPublicPath('public/dist/admin');

//mix.js('resources/jsBundler/admin/js/formio.js','js').extract(['vue']).vue({ version: 2 });
mix.js('resources/jsBundler/admin/js/app.js','/js').extract(['vue']).vue({ version: 2 });
