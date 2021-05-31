import Vue from 'vue';
import axios from 'axios';
import lodash from 'lodash';
import moment from 'moment';
import ElementUI from "element-ui";
import locale from "element-ui/lib/locale/lang/mn";
import VueLazyload from "vue-lazyload";
import vModal from 'vue-js-modal'
import VueSlimScroll from 'vue-slimscroll'
import VueTimeago from 'vue-timeago'
import AddThis from 'vue-simple-addthis-share';

axios.interceptors.request.use(function (config) {
    config.headers['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    return config;
});

window.Vue = Vue;
window._ = lodash;
window.axios = axios;
window.moment = moment;
Vue.config.productionTip = false;
Vue.config.silent = true;

Vue.use(vModal,{componentName: "paper-modal"});
Vue.use(VueSlimScroll);
Vue.use(VueTimeago, {
    name: 'Timeago',
    locale: 'en'
})
Vue.use(ElementUI, {locale});
Vue.use(VueLazyload, {
    preLoad: 1.3,
    error: "/assets/mle/images/nophoto.png",
    loading: "/assets/mle/images/loader.gif",
    attempt: 1
});

Vue.component('add-this', AddThis);


