var elixir = require('laravel-elixir');

require('laravel-elixir-vueify');

elixir(function(mix) {

	mix.sass('app.scss');
  mix.browserify('app.js');

	mix.styles([ 'vendor/animate.css', 'vendor/semantic.css' ], 'public/css/vendor.css');
	mix.scripts(['vendor/jquery.js'], 'public/js/vendor.js');

	mix.copy('resources/assets/css/vendor/fonts', 'public/fonts/');
});
