import VueRouter from 'vue-router'
import helper from './services/helper'

let routes = [
    {
        path: '/admin',
        component: require('./layouts/default-page'),
        meta: { requiresAuth: true },
        children: [
           
            {
                path: '/admin/home',
                component: require('./views/pages/home')
            },
            {
                path: '/admin/blank',
                component: require('./views/pages/blank')
            },
            {
                path: '/admin/configuration',
                component: require('./views/configuration/configuration')
            },
            {
                path: '/admin/profile',
                component: require('./views/user/profile')
            },
            {
                path: '/admin/task',
                component: require('./views/task/index')
            },
            {
                path: '/admin/task/:id/edit',
                component: require('./views/task/edit')
            },
            {
                path: '/admin/user',
                component: require('./views/user/index')
            },
            {
                path: '/admin/vehicle',
                component: require('./views/vehicle/index')
            },            
            {
                path: '/api/bookings',
                component: require('./views/booking/index')
            }
        ]
    },
    {
        path: '/',
        component: require('./layouts/guest-page'),
        meta: { requiresGuest: true },
        children: [
            {
                path: '/',
                component: require('./views/pages/index')
            },
            {
                path: '/index',
                component: require('./views/pages/index')
            },
            {
                path: '/login',
                component: require('./views/auth/login')
            },
            {
                path: '/password',
                component: require('./views/auth/password')
            },
            {
                path: '/register',
                component: require('./views/auth/register')
            },
            {
                path: '/auth/:token/activate',
                component: require('./views/auth/activate')
            },
            {
                path: '/password/reset/:token',
                component: require('./views/auth/reset')
            },
            {
                path: '/auth/social',
                component: require('./views/auth/social-auth')
            },
            {
                path: '/api/booking',
                component: require('./views/booking/booking')
            }
        ]
    },
    {
        path: '*',
        component : require('./layouts/error-page'),
        children: [
            {
                path: '*',
                component: require('./views/errors/page-not-found')
            }
        ]
    }
];

const router = new VueRouter({
	routes,
    linkActiveClass: 'active',
    mode: 'history'
});

router.beforeEach((to, from, next) => {

    if (to.matched.some(m => m.meta.requiresAuth)){
        return helper.check().then(response => {
            if(!response){
                return next({ path : '/login'})
            }

            return next()
        })
    }

    if (to.matched.some(m => m.meta.requiresGuest)){
        return helper.check().then(response => {
            if(response){
                return next({ path : '/'})
            }

            return next()
        })
    }

    return next()
});

export default router;
