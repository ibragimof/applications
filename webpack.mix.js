const mix = require('laravel-mix')
const path = require('path')

const directory = path.basename(path.resolve(__dirname))
const source = `platform/plugins/${directory}`
const dist = `public/vendor/core/plugins/${directory}`

mix
    .js(`${source}/resources/js/application-public.js`, `${dist}/js`)

if (mix.inProduction()) {
    mix
        .copy(`${dist}/js/application-public.js`, `${source}/public/js`)
}
