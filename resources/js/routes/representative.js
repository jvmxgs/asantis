import Proposals from './../views/representative/proposals'

export default [{
                path: 'proposals',
                name: 'proposals',
                components: {
                    content: Proposals
                },
                meta: {
                    auth: {roles: 'representative', redirect: {name:'login'}, forbiddenRedirect: '/403'}
                }
            }]
