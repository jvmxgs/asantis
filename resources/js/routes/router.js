import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import publicRoutes from './public'
import companyRoutes from './company'

var routes = companyRoutes.concat(publicRoutes);

const Router = new VueRouter({
    mode: 'history',
    routes
})


export default Router
