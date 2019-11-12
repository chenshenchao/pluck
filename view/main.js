import Vue from 'vue';
import App from '@/App.vue';
import router from '@/router';
import store from '@/store';
import element from '@/plugins/element';
import request from '@/plugins/request';
import storage from '@/plugins/storage';
import component from '@/plugins/component';

Vue.config.productionTip = false;
Vue.use(element);
Vue.use(request);
Vue.use(storage);
Vue.use(component);

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app');
