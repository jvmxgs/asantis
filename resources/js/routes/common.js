import Dashboard from './../views/Dashboard'
import Search from './../views/common/search'
import Load from './../views/common/load'

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
                path: 'loads/:loadnumber',
                name: 'loads',
                components: {
                    content: Load
                }
            }]
    }
]
