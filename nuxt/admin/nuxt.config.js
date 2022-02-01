const webpack = require('webpack')
const path = require('path')

const environment = process.env.NODE_ENV;
const env = require(`./env.${environment}.js`)

const BASE_URL = env.BASE_URL || '/admin'
const API_BASE_URL = env.API_BASE_URL || ''
const BASE_DIR = env.BASE_DIR || '/admin'
const BASE_PATH = BASE_URL + BASE_DIR

const LANG = 'ja'
const BASE_TITLE = env.BASE_TITLE || 'NOT4H'
const BASE_DESC = env.BASE_DESC || ''
const BASE_OGP = env.BASE_OGP || '/img/icons/ogp.jpg'
const GAcode = `window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', '${env.GATAG}');`

// images
const iconImages = BASE_DIR + 'img/icons/'
const ogpImages = BASE_URL + BASE_OGP

// pwa
const shortName = ''
const splashscreens = BASE_DIR + 'img/splashscreens/'

export default {
    // Target: https://go.nuxtjs.dev/config-target

    router: {
        base: '/admin'
    },  
    ssr: false,
    env:env,
    loading: false,
    // Target (https://go.nuxtjs.dev/config-target)
    target: 'static',
    // Global page headers (https://go.nuxtjs.dev/config-head)
    head: {
        htmlAttrs: {
            prefix: 'og: http://ogp.me/ns#',
            lang: LANG
        },
        titleTemplate: `%s${BASE_TITLE}`,
        meta: [
            { charset: 'utf-8' },
            { 'http-equiv': 'x-ua-compatible', content: 'ie=edge' },
            { name: 'viewport', content: 'width=device-width, initial-scale=1.0, viewport-fit=cover' },
            { name: 'format-detection', content: 'telephone=no, email=no, address=no' },
            { hid: 'description', name: 'description', content: BASE_DESC },
            { hid: 'og:site_name', property: 'og:site_name', content: BASE_TITLE },
            { hid: 'og:type', property: 'og:type', content: 'article' },
            { hid: 'og:url', property: 'og:url', content: BASE_URL  },
            { hid: 'og:title', property: 'og:title', content: BASE_TITLE },
            { hid: 'og:description', property: 'og:description', content: BASE_DESC },
            { hid: 'og:image', property: 'og:image', content: BASE_OGP  },
            { name: 'twitter:card', content: 'summary_large_image' },
            { name: 'apple-mobile-web-app-capable', content: 'yes' },
            { name: 'apple-mobile-web-app-status-bar-style', content: 'black-translucent' },
            { name: 'msapplication-TileColor', content: '#eff2f4' },
            { name: 'theme-color', content: '#eff2f4' },
        ],
        
    },

    // Global CSS: https://go.nuxtjs.dev/config-css
    css: [
        '@/assets/scss/app.scss',
    ],

    styleResources: {
            scss: [
                '@/assets/scss/foundation/_variables.scss',
                '@/assets/scss/foundation/_mixins.scss'
            ]
    },

    axios: {
        baseURL: API_BASE_URL + "/api/"        
    },
   
    // Auto import components: https://go.nuxtjs.dev/config-components
    plugins: [

        { src: '~plugins/AdobeFonts', ssr: false },
        { src: '~plugins/filters', ssr: false },
        { src: "~plugins/vue-inject.js", ssr: false },
        { src: "~plugins/v-scroll-lock.js", ssr: false },
        { src: "~plugins/vue-scrollto.js", ssr: false },
        { src: "~plugins/laravel-vue-pagination.js", ssr: false },
        { src: '~/plugins/jsonld', ssr: false },
        { src: '~/plugins/gtag', ssr: false },
        { src: "~plugins/vue-toastification.js", ssr: false },
        { src: "~plugins/vue-sanitize.js", ssr: false },
    ],

    // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
    buildModules: [
        
    ],
    components: true,
    // Modules: https://go.nuxtjs.dev/config-modules
    modules: [
        'nuxt-user-agent',
        '@nuxtjs/style-resources',
        '@nuxtjs/pwa',
        "@nuxtjs/axios",
        'nuxt-webfontloader',
        '@nuxtjs/auth-next',
        ['@nuxtjs/moment', ['ja']],
        '@nuxtjs/recaptcha',
    ],
    recaptcha: {
        hideBadge: true, 
        siteKey: '6LfzX0sbAAAAAAJxxAe0pFgCD_6JnadYTJLaHhll',
        version: 3, 
    },
    

    auth: {
        redirect: {
            login: '/login', 
            logout: '/login', 
            callback: false,
            home: '/'
        },
        localStorage: {
            prefix: 'not4h.admin.'
        },
        strategies: {
            Admin: {
                provider: 'laravel/jwt',
                url: '/Admin',
                token: {
                    property: 'access_token',
                    maxAge: 60 * 60,
                },
                refreshToken: {
                    property: 'access_token',
                    maxAge: 20160 * 60,
                },
               
                endpoints: {
                    login: { url: '/login', method: 'post', propertyName: 'access_token' },
                    logout: { url: '/logout', method: 'post' },
                    refresh: { url: '/refresh', method: 'post' , propertyName: 'access_token'}, // change to your refresh token url
                    user: { url: '/me', method: 'get', propertyName: false},
                }
            }
        },
    },
    // Build Configuration: https://go.nuxtjs.dev/config-build
    
    webfontloader: {
        google: {
            families: ["Noto+Sans+JP:400,600","Inter:400,600"]
        }
    },
  
    generate: {
        dir :  path.resolve(__dirname, '../../public/admin'),
    },
}
