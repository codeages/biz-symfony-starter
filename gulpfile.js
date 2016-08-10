// https://laravel.com/docs/5.2/elixir

var elixir = require('laravel-elixir');

elixir(function(mix) {

    mix.styles([
        './node_modules/bootstrap/dist/css/bootstrap.css',
        './node_modules/font-awesome/css/font-awesome.css',
    ], 'web/assets/common/css/vendor.css');

    mix.scripts([
        './node_modules/jquery/dist/jquery.js',
        './node_modules/bootstrap/dist/js/bootstrap.js',
    ], 'web/assets/common/js/vendor.js');

    mix.copy('./node_modules/font-awesome/fonts', 'web/assets/common/fonts');
    mix.copy('./node_modules/bootstrap/dist/fonts', 'web/assets/common/fonts');
    mix.copy('./src/AppBundle/Resources/assets', 'web/assets/app');

});