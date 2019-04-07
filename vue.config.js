const path = require('path');

const indexViewPath = path.join(__dirname, 'website', 'application', 'index', 'view', 'index');

module.exports = {
    publicPath: 'production' == process.env.NODE_ENV ? '/pluck' : '/',
    outputDir: './website/public/pluck',

    /**
     * Webpack 设置。
     */
    chainWebpack: config => {
        // 设置路径别名
        config.resolve.alias
            .set('@b', path.join(__dirname, 'backstage'))
            .set('@m', path.join(__dirname, 'mdshop'));
    },

    /**
     * 多页面处理。
     */
    pages: {
        pluck: {
            entry: 'backstage/main.js',
            template: 'backstage/index.html',
            filename: `${indexViewPath}/pluck.html`,
        },
        mdshop: {
            entry: 'mdshop/main.js',
            template: 'mdshop/index.html',
            filename: `${indexViewPath}/mdshop.html`,
        },
    },
    
    /**
     * 调试服务器。
     */
    devServer: {
        port: 8080,
        proxy: {
            '^/user': {
                target: 'http://127.0.0.1',
                ws: true,
                changeOrigin: true,
            },
            '^/captcha': {
                target: 'http://127.0.0.1',
                ws: true,
                changeOrigin: true,
            },
        },
    },
};
