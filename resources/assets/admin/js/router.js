import Router from 'vue-router'

Vue.use(Router)

let base = '/';

if (location.pathname && location.pathname != '/') {
    base = location.pathname.split('/').slice(0, -1).join('/');
}

let routes = []

export default new Router({
    base,
    routes,
    history: true,
    linkActiveClass: 'active'
})
