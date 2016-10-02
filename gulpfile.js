const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    var bootstrapPath = 'node_modules/bootstrap-sass/assets';
    var bowerDir = './resources/assets/bower/';
    var fontAwesomePath = 'node_modules/font-awesome/fonts';

    mix.sass('app.scss')
    mix.copy(fontAwesomePath, 'public/fonts');
    //mix.webpack(['app.js', './node_modules/gentelella/build/js/custom.js'], 'public/js/app.js');
    mix.webpack('app.js');
});
