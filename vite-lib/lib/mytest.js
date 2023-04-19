export default {
    install: (app, options) => {
        // inject a globally available $translate() method
        app.config.globalProperties.$mytest = (key) => {
            if (key === 'test') {
                return 'test'
            }
            return 'not test'
        }
    }
}