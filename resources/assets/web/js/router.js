import Router from 'vue-router'
Vue.use(Router)

let base = '/';

if (location.pathname && location.pathname != '/') {
    base = location.pathname.split('/').slice(0, -1).join('/');
}

let routes = [{
    path: '/',
    redirect: '/index'
},
    {
        name: 'index',
        path: '/index',
        component: () => import('./pages/web/index.vue'),
    },
    {
        name: 'apartments',
        path: '/apartments',
        component: () => import('./pages/web/apartments.vue'),
    },
    {
        name: 'apartmentdetail',
        path: '/apartmentdetail/:id',
        component: () => import('./pages/web/apartment-detail.vue'),
    },
    {
        name: 'news',
        path: '/news',
        component: () => import('./pages/web/news.vue'),
    },
    {
        name: 'newsdetail',
        path: '/newsdetail/:id',
        component: () => import('./pages/web/news-detail.vue'),
    },
    {
        name: 'plan',
        path: '/plan',
        component: () => import('./pages/web/plans.vue'),
    },
    {
        name: 'plandetail',
        path: '/plandetail/:id',
        component: () => import('./pages/web/plan-detail.vue'),
    },
    {
        name: 'plandownload',
        path: '/plandownload/:id',
        component: () => import('./pages/web/plan-full.vue'),
    },

    {
        name: 'law',
        path: '/law',
        component: () => import('./pages/web/law.vue'),
    },
    {
        name: 'tosk',
        path: '/tosk',
        component: () => import('./pages/web/tosk.vue'),
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: () => import('./pages/web/dashboard.vue'),
    },
    {
        name: 'Error',
        path: '/*',
        component: ()=>import('./pages/error/views/404.vue')
    },

]

// Vue.use(VueGtag, {
//     config: { id: "UA-54743224-7"}
// }, routes);

export default new Router({
    scrollBehavior() {
        return { x: 0, y: 0 };
    },
    base,
    routes,
    history: true,
    linkActiveClass: 'active'
})
