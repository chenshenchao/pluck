const path = require('path');
const TerserJSPlugin = require('terser-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const pluck = require('../pluck.config.js');
const mainPath = path.resolve(__dirname, 'main');

module.exports = {
    entry: {
        pc: `${mainPath}/pc.js`,
        md: `${mainPath}/md.js`,
    },
    output: {
        filename: `theme/[name].js`,
        path: pluck.website.publicPath
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
                {
                    loader: 'postcss-loader',
                    options: {
                        ident: 'postcss',
                        plugins: [
                            require('tailwindcss'),
                            require('autoprefixer'),
                        ],
                    },
                },
                {
                    loader: 'sass-loader',
                    options: {
                        implementation: require('sass'),
                    },
                },
            ]
        }, {
            test: /\.js$/,
            use: [{
                loader: 'babel-loader',
            }]
        }]
    },
    optimization: {
        minimizer: [new TerserJSPlugin({}), new OptimizeCSSAssetsPlugin({})],
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: `theme/[name].css`
        }),
    ],
};