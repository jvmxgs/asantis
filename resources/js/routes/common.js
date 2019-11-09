import Dashboard from './../views/Dashboard'
import Search from './../views/common/search'
import Freight from './../views/common/freight'

export default [
    {
        path: '/dashboard',
        component: Dashboard,
        name: 'dashboard',
        meta: {
          auth: {roles: ['admin', 'company', 'carrier'], redirect: {name: 'login'}, forbiddenRedirect: '/403'}
        },
        children: [{
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
