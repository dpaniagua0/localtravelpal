var elixir = require('laravel-elixir');

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
    mix.sass('app.scss');

    mix.copy('vendor/kartik-v/bootstrap-fileinput/css/fileinput.min.css', 
      'resources/assets/sass/vendor/_fileinput.min.scss');

    mix.copy('vendor/kartik-v/bootstrap-fileinput/js/fileinput.min.js', 
      'resources/assets/js/fileinput.min.js');

    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/','public/build/fonts/bootstrap'); 


    mix.browserify('app.js').scripts([
        'eModal.min.js',
        'select2.full.min.js',
        'fileinput.min.js', 
        'jquery.bootstrap.wizard.min.js',
        'jquery.form.min.js',
        'formValidation.min.js',
        'framework/bootstrap.min.js'
    ]);

/*    mix.scripts([
       
    ],  'public/js/form_validation.js', 'resources/assets/js');*/

    mix.version(["css/app.css", "js/app.js", "js/all.js"]);
});
