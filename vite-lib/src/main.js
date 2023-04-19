import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import { mytest } from '../lib/mytest.js'

createApp(App)
    .use(mytest)
    .mount('#app')
