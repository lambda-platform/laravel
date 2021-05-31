import Vue from 'vue';
import "./bootstrap"
import router from './router'
import App from './App';

Vue.prototype.$init = window.init;
Vue.prototype.$user = window.init.user;
Vue.prototype.$role = window.init.role;

new Vue({
    router,
    el: '#app',
    extends: App
});
