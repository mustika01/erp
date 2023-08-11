const mix = require('laravel-mix')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

if (require('fs').existsSync('.airdrop_skip')) {
    console.log('Assets already exist. Skipping compilation.')
    process.exit(0)
}

mix.setPublicPath('public')
mix.disableNotifications()

mix.js('resources/js/app.js', 'public/js')
mix.postCss('resources/css/app.css', 'public/css')

if (mix.inProduction()) {
    mix.version()
} else {
    mix.sourceMaps()
}
