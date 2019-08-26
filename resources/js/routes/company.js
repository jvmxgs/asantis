import Dashboard from './../views/Dashboard'
import NewLoad from './../views/company/NewLoad'
import MyLoads from './../views/company/MyLoads'
import AdminDashboard from './../views/admin/dashboard'

export default [
    {
        path: '/dashboard',
        component: Dashboard,
        name: 'dashboard',
        meta: {
          auth: {roles: ['admin', 'company', 'carrier'], redirect: {name: 'login'}, forbiddenRedirect: '/403'}
        },
        children: [{
                path: 'myloads',
                name: 'myloads',
                components: {
                    content:MyLoads
                },
                meta: {
                    auth: {roles: 'company', redirect: {name:'login'}, forbiddenRedirect: '/403'}
                }
            },
            {
                path: 'newload',
                name: 'newload',
                components: {
                    content:NewLoad
                },
                meta: {
                    auth: {roles: 'company', redirect: {name:'login'}, forbiddenRedirect: '/403'}
                }
            }]
    }
]
