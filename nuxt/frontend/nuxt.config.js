const webpack = require('webpack')
const path = require('path')

const environment = process.env.NODE_ENV;
const env = require(`./env.${environment}.js`)

const BASE_URL = env.BASE_URL || ''
const API_BASE_URL = env.API_BASE_URL || ''
const BASE_DIR = env.BASE_DIR || '/'
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
        link: [
            { rel: 'icon', sizes: '16x16', type: 'image/png', href: iconImages + 'favicon-16x16.png' },
            { rel: 'icon', sizes: '32x32', type: 'image/png', href: iconImages + 'favicon-32x32.png' },
            { rel: 'mask-icon', href: iconImages + 'safari-pinned-tab.svg', color:"#232628"},
            // apple touch icon
            { rel: 'apple-touch-icon', sizes: '180x180', href: iconImages + 'apple-touch-icon.png' },
            { href: splashscreens + 'iphone5_splash.png', media: '(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)', rel: 'apple-touch-startup-image' },
            { href: splashscreens + 'iphone6_splash.png', media: '(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)', rel: 'apple-touch-startup-image' },
            { href: splashscreens + 'iphoneplus_splash.png', media: '(device-width: 621px) and (device-height: 1104px) and (-webkit-device-pixel-ratio: 3)', rel: 'apple-touch-startup-image' },
            { href: splashscreens + 'iphonex_splash.png', media: '(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3)', rel: 'apple-touch-startup-image' },
            { href: splashscreens + 'iphonexr_splash.png', media: '(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2)', rel: 'apple-touch-startup-image' },
            { href: splashscreens + 'iphonexsmax_splash.png', media: '(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3)', rel: 'apple-touch-startup-image' },
            { href: splashscreens + 'ipad_splash.png', media: '(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2)', rel: 'apple-touch-startup-image' },
            { href: splashscreens + 'ipadpro1_splash.png', media: '(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2)', rel: 'apple-touch-startup-image' },
            { href: splashscreens + 'ipadpro3_splash.png', media: '(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2)', rel: 'apple-touch-startup-image' },
            { href: splashscreens + 'ipadpro2_splash.png', media: '(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2)', rel: 'apple-touch-startup-image' },
        ],
        script: [
            
            {
              hid: 'GAsrc',
              src: 'https://www.googletagmanager.com/gtag/js?id=' + env.GATAG
            },
            {
              hid: 'GAcode',
              innerHTML: GAcode
            }
          ],
          __dangerouslyDisableSanitizersByTagID: {
            'GAsrc': ['innerHTML'],
            'GAcode': ['innerHTML']
        }
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
        { src: "~plugins/vuejs-paginate.js", ssr: false },
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
        'nuxt-stripe-module',
        '@nuxtjs/recaptcha',
    ],
    recaptcha: {
        hideBadge: true, 
        siteKey: '6LfzX0sbAAAAAAJxxAe0pFgCD_6JnadYTJLaHhll',
        version: 3, 
    },
    stripe: {
        stripeAccount: env.STRIPE_ACCOUNT_ID,
        version: '2020-08-27',   // versionは固定にしておいた方が無難です。
        publishableKey: env.STRIPE_PUBLISHABLE_KEY,
        locale: 'ja',
    },

    auth: {
        redirect: {
            login: '/login', 
            logout: '/login', 
            callback: false,
            home: '/dashboard'
        },
        localStorage: {
            prefix: 'not4h.'
        },
        strategies: {
            User: {
                provider: 'laravel/jwt',
                url: '/Users',
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
    build: {
        transpile: ['gsap'],
        extend (config, ctx) {
            config.node = {
              fs: "empty" 
            }
        }
    },
    webfontloader: {
        google: {
            families: ["Noto+Sans+JP:400,500,700"]
        }
    },
  
    generate: {
        dir :  path.resolve(__dirname, '../../public/frontend'),
    },
}
