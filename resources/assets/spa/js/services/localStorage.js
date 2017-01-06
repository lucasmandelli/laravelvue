export default {
    set(key, value) {
        window.localStorage.setItem(key, value);
        return window.localStorage.getItem(key);
    },
    get(key, defaultValue = null) {
        return window.localStorage.getItem(key) || defaultValue;
    },
    setObject(key, value) {
        window.localStorage.setItem(key, JSON.stringify(value));
        return this.getObject(key);
    },
    getObject(key) {
        return JSON.parse(window.localStorage.getItem(key)) || null;
    },
    remove(key) {
        window.localStorage.removeItem(key);
    }
}