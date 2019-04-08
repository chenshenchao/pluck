const path = require('path');
const pluck = require('./pluck.config.js');

const indexViewPath = path.join(__dirname, 'website', 'application', 'index', 'view', 'index');
const producing = 'production' == process.env.NODE_ENV;

module.exports = {
    publicPath: producing ? `/${pluck.name}` : '/',
    outputDir: `./website/public/${pluck.name}`,

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
            entry: path.join(__dirname, 'backstage', 'main.js'),
            template: path.join(__dirname, 'backstage', 'index.html'),
            filename: producing ? `${indexViewPath}/pluck.html` : 'pluck.html',
            title: 'pluck',
        },
        mdshop: {
            entry: path.join(__dirname, 'mdshop', 'main.js'),
            template: path.join(__dirname, 'mdshop', 'index.html'),
            filename: producing ? `${indexViewPath}/mdshop.html` : 'mdshop.html',
            title: 'mdshop',
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
