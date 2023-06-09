import { defineAsyncComponent, reactive, defineCustomElement } from 'vue'

console.log('XpStoreUiKit: loading...')

let storer = reactive({
    name: 'xp-store-uikit',
    counter: 0,
})

export default {
    install: (app, options) => {

        // add global properties
        app.config.globalProperties.$xp = (cmd='') => {
            return cmd + ' from xp-store-uikit.js'
        }

        app.config.globalProperties.$storer = () => storer

    }
}