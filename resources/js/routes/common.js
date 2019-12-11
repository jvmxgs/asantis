import Dashboard from './../views/Dashboard'
import Home from './../views/Home'
import UserInfo from './../views/common/UserInfo'
import Search from './../views/common/search'
import Freight from './../views/common/freight'

export default [
    {
        path: '/dashboard',
        component: Dashboard,
        meta: {
          auth: {roles: ['admin', 'representative', 'company', 'carrier'], redirect: {name: 'login'}, forbiddenRedirect: '/403'}
        },
        children: [{
                path: '/',
                name: 'dashboard',
                components: {
                    content: Home
                }
            },
            {
                path: 'userinfo',
                name: 'userinfo',
                components: {
                    content: UserInfo
                }
            },
            {
                path: 'search',
                name: 'search',
                components: {
                    content: Search
                }
            },
            {
                path: 'freights/:freightnumber',
                name: 'freights',
                components: {
                    content: Freight
                }
            }]
    }
]
