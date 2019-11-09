import MyProposals from './../views/carrier/MyProposals'

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
