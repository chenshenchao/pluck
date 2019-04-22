import Vue from 'vue';
import Router from 'vue-router';
import panel from './groups/panel';

Vue.use(Router)

const router = new Router({
    mode: 'history',
    base: '/pluck/',
    routes: [panel, {
        path: '/login.html',
        name: 'login',
        component: () => import('@b/views/pages/Login.vue'),
        meta: {
            title: '登录',
        },
    }],
});

router.beforeEach((to, from, next) => {
    if (to.meta.title) {
        document.title = to.meta.title;
    }
    next();
});

export default router;