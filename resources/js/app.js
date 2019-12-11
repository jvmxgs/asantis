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
import VueSweetalert2 from 'vue-sweetalert2';


import VueInternationalization from 'vue-i18n';
import Locales from '../assets/js/vue-i18n-locales.generated.js';
import Router from './routes/router.js';

Vue.component('pagination', require('laravel-vue-pagination'));

const lang = document.documentElement.lang.substr(0, 2);

const i18n = new VueInternationalization({
    locale: lang,
    messages: Locales
});


import 'sweetalert2/dist/sweetalert2.min.css';
import '@fortawesome/fontawesome-free/js/all.js';



Vue.use(VueSweetalert2)
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
