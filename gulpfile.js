var elixir = require('laravel-elixir');

require('laravel-elixir-vueify');
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

elixir(function(mix) {
    mix.sass('app.scss', 'public/assets/css/app.css');
    
    mix.browserify([
        'app.js'
    ], 'resources/assets/js/builds/app.js');
    
    mix.scripts([
        'plugins/jquery.min.js',
        'plugins/classie.js',
        'plugins/bootstrap.min.js',
        'plugins/pace.min.js',
        'plugins/uiMorphingButton_fixed.js',
        'plugins/toastr.min.js',
        'builds/app.js'
    ], 'public/assets/js/app.js');
});
