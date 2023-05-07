import {
    createApp, defineAsyncComponent
} from 'vue'

import xpGaia from 'XpGaia'

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
.mount('#app')

