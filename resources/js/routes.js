import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Home from './views/Home'

import Register from './views/auth/register'
import Login from './views/auth/login'


import AdminDashboard from './views/admin/dashboard'

//company views
import NewLoad from './views/company/NewLoad'
import MyLoads from './views/company/MyLoads'

const Router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            meta: {
              auth: undefined
            }
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
            meta: {
              auth: false
            }
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: {
              auth: false
            }
        },
        // ADMIN ROUTES
        {
            path: '/admin',
            name: 'admin.dashboard',
            component: AdminDashboard,
            meta: {
                auth: {roles: 'admin', redirect: {name: 'login'}, forbiddenRedirect: '/403'}
            }
        },
        // company ROUTES
        {
            path: '/company/myloads',
            name: 'myloads',
            component: MyLoads
        },
        {
            path: '/company/newload',
            name: 'newload',
            component: NewLoad
        },
    ],
})


export default Router
