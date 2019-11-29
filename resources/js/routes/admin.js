import Dashboard from './../views/admin/dashboard'
import Representatives from './../views/admin/representatives'
import AddRepresentative from './../views/admin/addrepresentative'

export default [{
                    path: '/',
                    name: 'dashboard',
                    components: {
                        content: Dashboard
                    }
            },
            {
                path: 'representatives',
                name: 'representatives',
                components: {
                    content: Representatives
                },
                meta: {
                    auth: {roles: 'admin', redirect: {name:'login'}, forbiddenRedirect: '/403'}
                }
            },
            {
                path: 'addrepresentative',
                name: 'addrepresentative',
                components: {
                    content: AddRepresentative
                },
                meta: {
                    auth: {roles: 'admin', redirect: {name:'login'}, forbiddenRedirect: '/403'}
                }
            }]
