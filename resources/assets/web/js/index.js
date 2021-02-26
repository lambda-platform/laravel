import "./bootstrap"
import App from './App';

new Vue({
    components: {
        App
    },
    render: h => h(App),
}).$mount('#app');
