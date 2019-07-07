const path = require('path');
const websitePath = path.resolve(__dirname, 'website');

module.exports = {
    producing: 'production' == process.env.NODE_ENV,
    website: {
        rootPath: websitePath,
        appPath: path.resolve(websitePath, 'app'),
        publicPath: path.resolve(websitePath, 'public'),
        server: {
            target: 'http://127.0.0.1',
            ws: true,
            changeOrigin: true,
        },
    },
};