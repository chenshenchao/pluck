import axios from 'axios';
import qs from 'qs';
import lodash from 'lodash';
import uuidv4 from 'uuid/v4';
import { Message } from 'element-ui';
import store from '@/store';

/**
 * ajax 封装
 * 
 */
class AjaxRequester {
    /**
     * 
     */
    constructor() {
        this.axios = axios.create({
            timeout: 30000,
        });
        this.axios.interceptors.request.use(
            config => {
                if (!store.state.insider.token) {
                    store.commit('insider/ensure');
                }
                if (store.state.insider.token) {
                    config.headers['Authorization'] = store.state.insider.token;
                }
                return config;
            }
        );
        this.axios.interceptors.response.use(
            response => {
                if ('message' in response.data) {
                    Message.info({
                        center: true,
                        message: response.data.message,
                    });
                }
                return response;
            },
            error => {
                if ('data' in error.response && 'message' in error.response.data) {
                    Message.error({
                        center: true,
                        message: error.response.data.message,
                    });
                }
                return Promise.reject(error)
            }
        );
    }

    /**
     * 
     * @param {*} url 
     * @param {*} config 
     */
    get(url, query, config) {
        let path = url;
        let matches = url.match(/(.+?)(?:\?)(.+)/);
        if (lodash.isNil(query)) {
            query = {};
        }
        if (!lodash.isNull(matches)) {
            path = matches[1];
            query = {
                ...qs.parse(matches[2]),
                ...query,
            };
        }
        if (!lodash.isEmpty(query)) {
            url = path + '?' + qs.stringify(query);
        }
        return this.axios.get(url, config);
    }

    /**
     * 
     * @param {*} url 
     * @param {*} data 
     * @param {*} config 
     */
    post(url, data, config) {
        return this.axios.post(url, data, config);
    }

    /**
     * 
     * @param {*} url 
     * @param {*} data 
     * @param {*} config 
     */
    upload(url, data, config) {
        let sheet = new FormData();
        for (let key in data) {
            sheet.append(key, data[key]);
        }
        return this.axios.post(url, sheet, config);
    }

    /**
     * 
     * @param {} config 
     */
    request(config) {
        return this.axios.request(config);
    }
}

/**
 * Jsonp 封装
 * 
 */
class JsonpRequester {
    /**
     * 
     * @param {*} url 
     * @param {*} param 
     */
    request(url, param) {
        if (!param) {
            param = {};
        }
        if (!param.callback) {
            let uuid = uuidv4().replace(/-/g, '');
            param.callback = `vueXRequestJsonp${uuid}`;
        }
        return new Promise((resolve, reject) => {
            let element = document.createElement('script');
            element.src = url + '?' + qs.stringify(param);
            element.charset = 'utf-8';
            window[param.callback] = data => {
                resolve(data);
                delete window[param.callback];
            };
            element.onload = () => {
                document.body.removeChild(element);
            };
            element.onerror = e => {
                reject(e);
                document.body.removeChild(element);
            }
            document.body.appendChild(element);
        });
    }
}

export const ajax = new AjaxRequester();
export const jsonp = new JsonpRequester();

export default {
    install(Vue) {
        Vue.prototype.$ajax = ajax;
        Vue.prototype.$jsonp = jsonp;
    }
};