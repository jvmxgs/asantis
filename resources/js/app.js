//require('./bootstrap');
window.Vue = require('vue');

import VueFragment from "vue-fragment";
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
import Router from './routes/router.js';

const lang = document.documentElement.lang.substr(0, 2);

const i18n = new VueInternationalization({
    locale: lang,
    messages: Locales
});

Vue.use(VueFragment.Plugin);
Vue.router = Router
Vue.use(VueRouter)
Vue.use(VueAxios, axios)
axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`
Vue.use(VueAuth, auth)


const app = new Vue({
  el: '#app',
  i18n,
  router: Router
});
