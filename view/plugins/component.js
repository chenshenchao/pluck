export default {
    install(Vue) {
        const requireComponent = require.context('@/components', true, /\w+\.vue/);
        requireComponent.keys().forEach(filename => {
            const componentConfig = requireComponent(filename);
            if (componentConfig.default.name || componentConfig.name) {
                Vue.component(
                    componentConfig.default.name || componentConfig.name,
                    componentConfig.default || componentConfig
                );
            }
        });
    }
}