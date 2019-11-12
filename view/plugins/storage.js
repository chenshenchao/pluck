/**
 * 存储管理器。
 * 
 */
class BaseStorage {
    /**
     * 
     * @param {*} duration 
     */
    constructor(storage, duration) {
        this.storage = storage;
        this.duration = duration;
    }

    /**
     * 获取信息。
     * 
     * @param {*} name 键名
     * @param {*} defaultValue 默认值
     */
    get(name, defaultValue) {
        let now = new Date().getTime();
        let text = this.storage.getItem(name);
        if (!text) {
            return defaultValue;
        }
        let data = JSON.parse(text);
        let expired = data.expired || Infinity;
        if (expired < now) {
            this.storage.removeItem(name);
            return defaultValue;
        }
        return data.value;
    }

    /**
     * 获取信息。
     * 
     * @param {*} name 键名
     * @param {*} value 值
     * @param {*} duration 持续时间
     */
    set(name, value, duration) {
        let now = new Date().getTime();
        let data = {
            value: value,
            expired: now + (duration || this.duration)
        }
        this.storage.setItem(name, JSON.stringify(data));
    }

    /**
     * 删除信息。
     * 
     * @param {*} name 键名
     */
    drop(name) {
        this.storage.removeItem(name);
    }

    /**
     * 清除所有信息。
     * 
     */
    clear() {
        this.storage.clear();
    }
}

/**
 * 缓存管理
 * 
 */
class CacheStorage extends BaseStorage {
    /**
     * 初始化
     * 
     * @param {*} duration 持续时间
     */
    constructor(duration) {
        super(localStorage, duration || (60 * 60 * 1000));
    }
}

/**
 * 会话管理
 * 
 */
class SessionStorage extends BaseStorage {
    /**
     * 初始化。
     * 
     * @param {*} duration 持续时间
     */
    constructor(duration) {
        super(sessionStorage, duration || Infinity);
    }
}

export const cache = new CacheStorage();
export const session = new SessionStorage();

export default {
    install(Vue) {
        Vue.prototype.$cache = cache;
        Vue.prototype.$session = session;
    },
};