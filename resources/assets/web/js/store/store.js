/**
 * Created by n0m4dz on 5/29/17.
 */
import Vuex from 'vuex'
Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
        user: window.init.user,
    },

    getters: {
        user: state => state.user,
    },

    modules: {}
});
