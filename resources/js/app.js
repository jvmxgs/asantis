//require('./bootstrap');
window.Vue = require('vue');


import 'es6-promise/auto'
import axios from 'axios'
import './bootstrap'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import Index from './views/Index'
import auth from './auth'



import VueInternationalization from 'vue-i18n';
import Locales from '../assets/js/vue-i18n-locales.generated.js';
import Router from './routes.js';


/*
Vue.component('menu-component', require('./components/MenuComponent.vue').default);
Vue.component('loadrow-component', require('./components/LoadRowComponent.vue').default);
*/

const lang = document.documentElement.lang.substr(0, 2);

const i18n = new VueInternationalization({
    locale: lang,
    messages: Locales
});


Vue.router = Router
Vue.use(VueRouter)
Vue.use(VueAxios, axios)
axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`
Vue.use(VueAuth, auth)




Vue.component('index-component', Index);

const app = new Vue({
  el: '#app',
  i18n,
  router: Router
});

/*

const app = new Vue({
    el: '#app',
    i18n,
    router: Router
});
*/
