import MyTestA from './MyTestA.vue'


let mytest = {
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

export {
    mytest,
    MyTestA
}