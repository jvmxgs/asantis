import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import publicRoutes from './public'
import companyRoutes from './company'
import commonRoutes from './common'

var routes = [...publicRoutes, ...commonRoutes];

routes.forEach((route, index) => {
    if(route.name === 'dashboard') {
        routes[index]['children'] = route['children'].concat(companyRoutes)
    }
});

const Router = new VueRouter({
    mode: 'history',
    routes
})


export default Router
