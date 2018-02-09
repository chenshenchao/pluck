path = require 'path'

ExtractTextPlugin = require 'extract-text-webpack-plugin'

module.exports =
    entry:
        pluck: path.resolve __dirname, 'frontend/pluck.coffee'
        setup: path.resolve __dirname, 'frontend/setup.coffee'
        login: path.resolve __dirname, 'frontend/login.coffee'
    output:
        filename: 'scripts/[name].min.js'
        path: path.resolve __dirname, 'asset'
    module:
        rules: [
            {
                test: /\.scss$/
                use: ExtractTextPlugin.extract {
                    fallback: 'style-loader'
                    use: [
                        'css-loader'
                        'sass-loader'
                    ]
                }
            }
            {
                test: /\.coffee$/
                use: 'coffee-loader'
            }
        ]
    plugins: [
        new ExtractTextPlugin 'styles/[name].min.css'
    ]