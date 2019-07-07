const path = require('path');
const pluck = require('../pluck.config.js');
const name = 'pluck';

module.exports = {
    publicPath: pluck.producing ? `/${name}` : '/',
    outputDir: `${pluck.website.publicPath}/${name}`,

    /**
     * 调试服务器。
     */
    devServer: {
        port: 8080,
        proxy: {
            '^/staff': pluck.website.server,
            '^/captcha': pluck.website.server,
        },
    },
};
