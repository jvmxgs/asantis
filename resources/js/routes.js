import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Home from './views/Home'

//company views
import NewLoad from './views/company/NewLoad'
import MyLoads from './views/company/MyLoads'

const Router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/home',
            name: 'home',
            component: Home
        },
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
