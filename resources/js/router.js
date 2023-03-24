import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    {
        path: '/',
        name: 'dashboard',
        component: () => import('./pages/Dashboard.vue'),
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('./pages/Users/Login.vue'),
        meta: {
            requiresAuth: false
        }
    },
    {
        path: '/register',
        name: 'register',
        component: () => import('./pages/Users/Register.vue'),
        meta: {
            requiresAuth: false
        }
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('access_token')
    // if(token != null){
    //     axios.get('/api/v1/user', {
    //         headers: {
    //             'Authorization': 'Bearer ' + token,
    //         }
    //     })
    //         .catch(error => {
    //             localStorage.removeItem('access_token')
    //             this.$router.push({name: 'login'})
    //         })
    // }
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth)
    if (requiresAuth && !token) {
        next('/login')
    } else {
        next()
    }
})

export default router;
