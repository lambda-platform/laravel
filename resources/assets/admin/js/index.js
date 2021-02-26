import "./bootstrap"
import App from './App';
import router from "./router";

Vue.prototype.$init = window.init;
Vue.prototype.$user = window.init.user;
Vue.prototype.$logo = window.logo;

new Vue({
    components: {
        App
    },
    router,
    render: h => h(App),
}).$mount('#app');
