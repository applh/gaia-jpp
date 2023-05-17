import {
    createApp, defineAsyncComponent
} from 'vue'

import xpGaia from 'XpGaia'
import { mytest } from 'vitelib'

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
.mount('#app')

