import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import publicRoutes from './public'
import adminRoutes from './admin'
import companyRoutes from './company'
import carrierRoutes from './carrier'
import commonRoutes from './common'

var routes = [...publicRoutes, ...commonRoutes];

routes.forEach((route, index) => {
    if(route.path === '/dashboard') {
        routes[index]['children'] = route['children'].concat(companyRoutes)
                                                    .concat(carrierRoutes)
                                                    .concat(adminRoutes)
    }
});

const Router = new VueRouter({
    mode: 'history',
    routes
})


export default Router
