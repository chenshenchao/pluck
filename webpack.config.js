const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const VueLoaderPlugin = require('vue-loader/lib/plugin');

module.exports = {
    entry: {
        pluck: path.resolve(__dirname, 'view', 'pluck.js'),
        setup: path.resolve(__dirname, 'view', 'setup.js'),
        login: path.resolve(__dirname, 'view', 'login.js')
    },
    output: {
        filename: 'scripts/[name].js',
        path: path.resolve(__dirname, 'asset')
    },
    
    performance: {
        hints: false
    },
    module: {
        rules: [{
            test: /\.vue$/,
            loader: 'vue-loader',
        }, {
            test: /\.svg$/,
            loader: 'raw-loader',
        }, {
            test: /\.css$/,
            use: [
                MiniCssExtractPlugin.loader,
                'css-loader',
                'postcss-loader',
            ]
        }, {
            test: /\.js$/,
            loader: 'babel-loader'
        }]
    },
    plugins: [
        new MiniCssExtractPlugin('styles/[name].css'),
        new VueLoaderPlugin()
    ]
};