import Router from 'vue-router'

Vue.use(Router)

let base = '/';

if (location.pathname && location.pathname != '/') {
    base = location.pathname.split('/').slice(0, -1).join('/');
}

let routes = [
    {
        path: '/',
        redirect: '/dashboard'
    },
    {
        name: 'Dashboard',
        path: '/dashboard',
        component: require('./pages/dashboard/views/index.vue').default
    },
    {
        path: '/p/:menu_id',
        component: require('./pages/page/views/index').default,
        children: [{
            path: ':sub_menu_id',
            component: require('./pages/page/views/sub').default,
        }]
    },
    {
        path: '/module/:module',
        component: require('./pages/page/views/module').default,
    },
    {
        path: '/building',
        component: require('./pages/building/views/index').default,
        children: [
            {
                path: '/',
                redirect: 'crud/list/Барилга/304'
            },
            {
                path: 'crud/:template/:title/:grid',
                component: require('./pages/building/views/barilgalist').default,
            },
            {
                path: 'crud1/:template/:title/:grid',
                component: require('./pages/building/views/barilgalistshineoronsuuts').default,
            },
            {
                path: 'crud2/:template/:title/:grid',
                component: require('./pages/building/views/barilgalistaminiioronsuuts').default,
            },
            {
                path: 'crud/:template/:title/:grid/:form',
                component: require('./pages/building/views/crud').default,
            },
            {
                path: 'edit/:schema/:id',
                component: require('./pages/building/views/edit').default,
            },
            {
                path: 'barilga/createbarilga/:actiontype/:id/:barilgaid',
                component: require('./pages/building/views/barilga').default,
                props: true
            },
            {
                path: 'barilga/import',
                component: require('./pages/building/views/import').default,
            },
            {
                path: 'barilga/map',
                component: require('./pages/building/views/map').default,
            }
        ]
    },
    {
        path: '/buildingsub',
        component: require('./pages/buildingsub/views/index'),
        children: [{
            path: '/',
            redirect: 'crud/list/Барилга/104'
        },
            {
                path: 'crud/:template/:title/:grid',
                component: require('./pages/buildingsub/views/barilgalist').default,
            },
            {
                path: 'crud1/:template/:title/:grid',
                component: require('./pages/buildingsub/views/barilgalistshineoronsuuts').default,
            },
            {
                path: 'crud2/:template/:title/:grid',
                component: require('./pages/buildingsub/views/barilgalistaminiioronsuuts').default,
            },
            {
                path: 'crud/:template/:title/:grid/:form',
                component: require('./pages/buildingsub/views/crud').default,
            },
            {
                path: 'edit/:schema/:id',
                component: require('./pages/buildingsub/views/edit').default,
            },
            {
                path: 'barilga/createbarilga/:actiontype/:id/:barilgaid',
                component: require('./pages/buildingsub/views/barilga').default,
                props: true
            },
            {
                path: 'barilga/import',
                component: require('./pages/buildingsub/views/import').default,
            },
            {
                path: 'barilga/map',
                component: require('./pages/buildingsub/views/map').default,
            }
        ]
    },
    {
        path: '/buildingnet',
        component: require('./pages/buildingnet/views/index'),
        children: [{
            path: '/',
            redirect: 'crud/list/Барилга/104'
        },
            {
                path: 'crud/:template/:title/:grid',
                component: require('./pages/buildingnet/views/barilgalist').default,
            },
            {
                path: 'crud1/:template/:title/:grid',
                component: require('./pages/buildingnet/views/barilgalistshineoronsuuts').default,
            },
            {
                path: 'crud2/:template/:title/:grid',
                component: require('./pages/buildingnet/views/barilgalistaminiioronsuuts').default,
            },
            {
                path: 'crud/:template/:title/:grid/:form',
                component: require('./pages/buildingnet/views/crud').default,
            },
            {
                path: 'edit/:schema/:id',
                component: require('./pages/buildingnet/views/edit').default,
            },
            {
                path: 'barilga/createbarilga/:actiontype/:id/:barilgaid',
                component: require('./pages/buildingnet/views/barilga').default,
                props: true
            },
            {
                path: 'barilga/import',
                component: require('./pages/buildingnet/views/import').default,
            },
            {
                path: 'barilga/map',
                component: require('./pages/buildingnet/views/map').default,
            }
        ]
    },
    {
        path: '/buildingyam',
        component: require('./pages/buildingyam/views/index').default,
        children: [{
            path: '/',
            redirect: 'crud/list/Барилга/204'
        },
            {
                path: 'crud/:template/:title/:grid',
                component: require('./pages/buildingyam/views/barilgalist').default,
            },
            {
                path: 'crud1/:template/:title/:grid',
                component: require('./pages/buildingyam/views/barilgalistshineoronsuuts').default,
            },
            {
                path: 'crud2/:template/:title/:grid',
                component: require('./pages/buildingyam/views/barilgalistaminiioronsuuts').default,
            },
            {
                path: 'crud/:template/:title/:grid/:form',
                component: require('./pages/buildingyam/views/crud').default,
            },
            {
                path: 'edit/:schema/:id',
                component: require('./pages/buildingyam/views/edit').default,
            },
            {
                path: 'barilga/createbarilga/:actiontype/:id/:barilgaid',
                component: require('./pages/buildingyam/views/barilga').default,
                props: true
            },
            {
                path: 'barilga/import',
                component: require('./pages/buildingyam/views/import').default,
            },
            {
                path: 'barilga/map',
                component: require('./pages/buildingyam/views/map').default,
            }
        ]
    },
    {
        path: '/buildingmic',
        component: require('./pages/buildingmic/views/index').default,
        children: [{
            path: '/',
            redirect: 'crud/list/Барилга/204'
        },
            {
                path: 'crud/:template/:title/:grid',
                component: require('./pages/buildingmic/views/barilgalist').default,
            },
            {
                path: 'crud1/:template/:title/:grid',
                component: require('./pages/buildingmic/views/barilgalistshineoronsuuts').default,
            },
            {
                path: 'crud2/:template/:title/:grid',
                component: require('./pages/buildingmic/views/barilgalistaminiioronsuuts').default,
            },
            {
                path: 'crud/:template/:title/:grid/:form',
                component: require('./pages/buildingmic/views/crud').default,
            },
            {
                path: 'edit/:schema/:id',
                component: require('./pages/buildingmic/views/edit').default,
            },
            {
                path: 'barilga/createbarilga/:actiontype/:id/:barilgaid',
                component: require('./pages/buildingmic/views/barilga').default,
                props: true
            },
            {
                path: 'barilga/import',
                component: require('./pages/buildingmic/views/import').default,
            },
            {
                path: 'barilga/map',
                component: require('./pages/buildingmic/views/map').default,
            }
        ]
    },
    {
        path: '/buildingtosk',
        component: require('./pages/buildingtosk/views/index').default,
        children: [{
            path: '/',
            redirect: 'crud/list/Барилга/204'
        },
            {
                path: 'crud/:template/:title/:grid',
                component: require('./pages/buildingtosk/views/barilgalist').default,
            },
            {
                path: 'crud1/:template/:title/:grid',
                component: require('./pages/buildingtosk/views/barilgalistshineoronsuuts').default,
            },
            {
                path: 'crud2/:template/:title/:grid',
                component: require('./pages/buildingtosk/views/barilgalistaminiioronsuuts').default,
            },
            {
                path: 'crud/:template/:title/:grid/:form',
                component: require('./pages/buildingtosk/views/crud').default,
            },
            {
                path: 'edit/:schema/:id',
                component: require('./pages/buildingtosk/views/edit').default,
            },
            {
                path: 'barilga/createbarilga/:actiontype/:id/:barilgaid',
                component: require('./pages/buildingtosk/views/barilga').default,
                props: true
            },
            {
                path: 'barilga/import',
                component: require('./pages/buildingtosk/views/import').default,
            },
            {
                path: 'barilga/map',
                component: require('./pages/buildingtosk/views/map').default,
            }
        ]
    },
    {
        path: '/zar',
        component: require('./pages/zar/views/index'),
        children: [{
            path: '/',
            redirect: 'apartment/list/Орон-сууц/98'
        },
            {
                // path: 'crud/:template/:title/:grid/:form',
                path: 'crud/:template/:title/:grid',
                component: require('./pages/zar/views/crud'),
            },
            {
                path: 'apartment/create/:actiontype/:id/:barilgaid',
                component: require('./pages/zar/views/apartment'),
                props: true
            },
            {
                path: 'newapartment/create/:actiontype/:id/:barilgaid',
                component: require('./pages/zar/views/newapartment'),
                props: true
            },
            {
                // path: 'crud/:template/:title/:grid/:form',
                path: 'apartment/:template/:title/:grid',
                component: require('./pages/zar/views/apartmentlist'),
            }
        ]
    },
    {
        path: '/report',
        component: require('./pages/report/views/index'),
        children: [{
            path: '/',
            redirect: 'analytics'
        },
            {
                path: 'house',
                component: require('./pages/report/views/house'),
            },
            {
                path: 'analytics',
                component: require('./pages/report/views/analytics'),
            },
        ]
    },
    {
        path: '/faq',
        component: require('./pages/faq/views/index'),
        children: [{
            path: '/',
            redirect: 'crud/canvas/Компани/39/49'
        },
            {
                path: 'edit/:schema/:id',
                component: require('./pages/faq/views/edit'),
            },
            {
                path: 'crud/:template/:title/:grid/:form',
                component: require('./pages/faq/views/crud'),
            }
        ]
    },
    {
        path: '/help',
        component: require('./pages/help/views/index').default,
    },
    {
        path: '/helpuser',
        component: require('./pages/helpuser/views/index').default,
    },
    {
        path: '/setting',
        component: require('./pages/setting/views/index').default,
        children: [
            {
                path: '/',
                redirect: 'crud/canvas/Тогтмол-утга/60/61'
            },
            {
                path: 'edit/:schema/:id',
                component: require('./pages/setting/views/edit').default,
            },
            {
                path: 'crud/:template/:title/:grid',
                component: require('./pages/setting/views/grid').default,
            },
            {
                path: 'crud/:template/:title/:grid/:form',
                component: require('./pages/setting/views/crud').default,
            }
        ]
    },
    {
        path: '/tosk',
        component: require('./pages/tosk/views/index'),
        children: [
            {
                path: '/',
                redirect: 'crud/canvas/Барилга/266/208'
            },
            {
                path: 'edit/:schema/:id',
                component: require('./pages/tosk/views/edit'),
            },
            {
                path: 'crud/:template/:title/:grid',
                component: require('./pages/tosk/views/grid'),
            },
            {
                path: 'crud/:template/:title/:grid/:form',
                component: require('./pages/tosk/views/crud'),
            }
        ]
    },
    {
        name: 'Error',
        path: '/*',
        component: require('./pages/error/views/404.vue').default
    }
]

export default new Router({
    base,
    routes,
    history: true,
    linkActiveClass: 'active'
})
