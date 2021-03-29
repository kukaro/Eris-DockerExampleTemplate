import Vue from 'vue'
import App from '@/App'
import vuetify from './plugins/vuetify';
import Vuex from 'vuex';
import router from './router';
import store from './store';

Vue.config.productionTip = false

Vue.use(Vuex);

new Vue({
  vuetify,
  router,
  store,
  render: h => h(App)
}).$mount('#app')
