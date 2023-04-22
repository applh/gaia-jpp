import { createApp } from 'vue'
import './style.css'
import App from './App.vue'

// import xp_plugin
import { xp_plugin } from './lib/xp-plugin.js'

createApp(App)
    .use(xp_plugin)
    .mount('#app')

