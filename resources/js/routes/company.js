import FormFreight from './../views/company/FormFreight'
import MyFreights from './../views/company/MyFreights'

export default [{
                path: 'myfreights',
                name: 'myfreights',
                components: {
                    content: MyFreights
                },
                meta: {
                    auth: {roles: 'company', redirect: {name:'login'}, forbiddenRedirect: '/403'}
                }
            },
            {
                path: 'newfreight',
                name: 'newfreight',
                components: {
                    content: FormFreight
                },
                meta: {
                    auth: {roles: 'company', redirect: {name:'login'}, forbiddenRedirect: '/403'}
                }
            },
            {
                path: 'updatefreight/:freight_number',
                name: 'updatefreight',
                components: {
                    content: FormFreight
                },
                meta: {
                    auth: {roles: 'company', redirect: {name:'login'}, forbiddenRedirect: '/403'}
                }
            }]
