import Dashboard from './../views/Dashboard'
import Search from './../views/common/search'

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
            }]
    }
]
