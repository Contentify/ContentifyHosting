const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

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

/*
 * Elixir Frontend
 */
elixir(mix => {
    mix.sass(
    		'./resources/assets/frontend/sass/app.scss',
    		'./public/assets/frontend/css'
    	)
       .webpack(
       		'./resources/assets/frontend/js/app.js',
       		'./public/assets/frontend/js'
      );
});

/*
 * Elixir Backend
 */
elixir(mix => {
    mix.sass(
    		'./resources/assets/backend/sass/app.scss',
    		'./public/assets/backend/css'
    	)
       .webpack(
       		'./resources/assets/backend/js/app.js',
       		'./public/assets/backend/js'
      );
});

/*
 * Elixir Versionning
 */
 elixir(mix => {
    mix.version(
        ['assets/frontend/css/app.css', 'assets/frontend/js/app.js', 'assets/backend/css/app.css', 'assets/backend/js/app.js']
      );
});

