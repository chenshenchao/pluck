import Vue from 'vue/dist/vue';
import Vuex from 'vuex';
import VueRouter from 'vue-router';

import IndexPage from './page/setup/index.vue';

Vue.use(Vuex);
Vue.use(VueRouter);

/**
 * 状态。
 * 
 */
let store = new Vuex.Store({
    state: {

    }
});

/**
 * 路由。
 * 
 */
let router = new VueRouter({
    mode: 'history',
    base: '/setup',
    routes: [{
        path: '/index.html',
        component: IndexPage,
    }]
});

/**
 * 应用。
 * 
 */
let application = new Vue({
    el: '#application',
    store,
    router,
});