const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const pluck = require('./pluck.config.js');

const commonViewPath = path.resolve(__dirname, 'website', 'application', 'common', 'view');

module.exports = {
    entry: {
        pc: `${commonViewPath}/pc.js`,
        md: `${commonViewPath}/md.js`,
    },
    output: {
        filename: `${pluck.name}/js/[name].js`,
        path: path.resolve(__dirname, 'website', 'public')
    },
    devtool: "source-map",
    performance: { hints: false },
    watchOptions: {
        ignored: /node_modules/,
        aggregateTimeout: 300,
        poll: 1000
    },
    module: {
        rules: [{
            test: /\.svg$/,
            loader: 'raw-loader',
        }, {
            test: /\.scss$/,
            use: [
                MiniCssExtractPlugin.loader,
                'css-loader',
                'sass-loader',
            ]
        }, {
            test: /\.js$/,
            use: [{
                loader: 'babel-loader',
            }]
        }]
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: `${pluck.name}/css/[name].css`
        }),
    ],
};