import Dashboard from './../views/admin/dashboard'
import Representatives from './../views/admin/representatives'
import FormRepresentative from './../views/admin/FormRepresentative'

export default [{
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
                    content: FormRepresentative
                },
                meta: {
                    auth: {roles: 'admin', redirect: {name:'login'}, forbiddenRedirect: '/403'}
                }
            },
            {
                path: 'updaterepresentative/:representative_id',
                name: 'updaterepresentative',
                components: {
                    content: FormRepresentative
                },
                meta: {
                    auth: {roles: 'admin', redirect: {name:'login'}, forbiddenRedirect: '/403'}
                }
            }]
