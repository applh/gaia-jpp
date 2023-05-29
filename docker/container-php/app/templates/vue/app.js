import {
    createApp, defineAsyncComponent
} from 'vue'

import xpGaia from 'XpGaia'
import { mytest } from 'vitelib'
import ElementPlus from 'ElementPlus'

createApp({
    template: '#appTemplate',
    data() {
        return {
            message: 'Hello Vue!',
            counter: 0
        }
    }
})
.use(xpGaia)
.use(mytest)
.use(ElementPlus)
.mount('#app')

