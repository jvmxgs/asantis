import NewFreight from './../views/company/NewFreight'
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
                    content: NewFreight
                },
                meta: {
                    auth: {roles: 'company', redirect: {name:'login'}, forbiddenRedirect: '/403'}
                }
            }]
