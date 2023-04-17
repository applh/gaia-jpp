import { createApp } from 'vue'
import './style.css'
import App from './App.vue'


let app  = createApp(App)
app.mount('#app')

// HACK: to publish the app instance
import { pjs } from './components/data-store.js'
pjs.app = app

// WARNING: avoid this syntax
// let data_store = await import('./components/data-store.js') 
// data_store.default.pjs.app = app

