require('./bootstrap');

window.Vue = require('vue');

import VueInternationalization from 'vue-i18n';
import Locales from '../assets/js/vue-i18n-locales.generated.js';
import Router from './routes.js';


Vue.component('menu-component', require('./components/MenuComponent.vue').default);
Vue.component('loadrow-component', require('./components/LoadRowComponent.vue').default);

const lang = document.documentElement.lang.substr(0, 2);

const i18n = new VueInternationalization({
    locale: lang,
    messages: Locales
});


const app = new Vue({
    el: '#app',
    i18n,
    router: Router
});
