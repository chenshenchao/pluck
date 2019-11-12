import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [{
    path: '/',
    name: 'panel-page',
    component: () => import('@/pages/Panel.vue')
  }, {
    path: '/login.html',
    name: 'login-page',
    component: () => import('@/pages/Login.vue')
  }],
});

router.beforeEach((to, from, next) => {
  if (to.meta && to.meta.title) {
    document.title = to.meta.title;
  }
  next();
});

export default router;
