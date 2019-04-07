import Vue from 'vue';
import App from './App.vue';
import router from './routes';
import store from './stores';
import Vant from 'vant';
import 'vant/lib/index.css';

Vue.config.productionTip = false;
Vue.use(Vant);

new Vue({
    router,
    store,
    render: h => h(App),
}).$mount('#app');
