import Vue from 'vue';
import Vuex from 'vuex';
import router from '@/router';

Vue.use(Vuex);

const data = {
    state: {
        isLogin: false,
        userId: '',
    },
    getters: {},
    mutations: {
        loginEvent(state, {userId, userPassword}) {
            state.isLogin = true;
            state.userId = userId;
            state.userPassword = userPassword;
            router.push('sample');
        }
    },
    actions: {}
}

export default new Vuex.Store(data);