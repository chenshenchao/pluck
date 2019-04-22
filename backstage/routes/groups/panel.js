export default {
    path: '/panel.html',
    name: 'panel',
    component: () => import('@b/views/pages/Panel.vue'),
    meta: {
        title: '管理面板',
    },
    children: [{
        path: '/panel/storage.html',
        name: 'storage',
        component: () => import('@b/views/panels/Storage.vue'),
        meta: {
            title: '存储管理',
        }
    }]
};