import Vue from 'vue';
import Router from 'vue-router';
import SamplePage from '@/pages/Sample'
import LoginPage from '@/pages/Login'

Vue.use(Router);

export default new Router({
    routes: [
        {
            path:'/',
            component: LoginPage
        },
        {
            path:'/sample',
            component: SamplePage
        },
        {
            path:'/Login',
            component: LoginPage
        },
    ],
});