const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');

const name = process.env.NAME || 'sheen';
const proxy = {};
proxy[`^/${process.env.PROXY_API_PREFIX || 'api'}`] = {
    target: process.env.PROXY_TARGET || 'http://127.0.0.1',
    ws: true,
    changeOrigin: true,
};

module.exports = {
    publicPath: 'production' == process.env.NODE_ENV ? `/${name}` : '/',
    outputDir: path.resolve(__dirname, 'view', 'products'),
    indexPath: 'index.html',
    configureWebpack: {
        entry: '@/main.js',
        resolve: {
            alias: {
                '@': path.resolve(__dirname, 'view'),
            },
        },
        plugins: [
            new HtmlWebpackPlugin({
                filename: 'index.html',
                template: path.resolve(__dirname, 'view', 'index.html')
            }),
        ]
    },
    devServer: {
        port: 8080,
        proxy: proxy,
        contentBase: path.resolve(__dirname, 'view', 'assets'),
    },
};