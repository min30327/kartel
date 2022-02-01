import Vue from 'vue';
import VueRouterBackButton from 'vue-router-back-button'

export default ({ app }) => {
    Vue.use(VueRouterBackButton, { router: app.router });
};