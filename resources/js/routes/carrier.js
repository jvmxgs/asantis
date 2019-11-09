import MyProposals from './../views/carrier/myproposals'

export default [{
                path: 'myproposals',
                name: 'myproposals',
                components: {
                    content: MyProposals
                },
                meta: {
                    auth: {roles: 'carrier', redirect: {name:'login'}, forbiddenRedirect: '/403'}
                }
            }]
