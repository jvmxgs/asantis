import Welcome from './../views/Welcome'
import Register from './../views/auth/register'
import Login from './../views/auth/login'
import View403 from './../views/403'

export default [
    {
        path: '/',
        name: 'welcome',
        component: Welcome,
        meta: {
          auth: undefined
        }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
          auth: false
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
          auth: false
        }
    },
    {
        path: '/403',
        name: '403',
        component: View403
    }
]
