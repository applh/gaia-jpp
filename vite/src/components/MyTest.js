import { defineAsyncComponent } from 'vue'


let data_store = await import('./data-store.js')
// import data_store from '../assets/data-store.js'

// console.log('data_store', data_store)
// let dyn_compo = function (name) {
//     // HACK: this is a hack to get the app instance
//     if (data_store.default.pjs.app) {
//         let app = data_store.default.pjs.app
//         // check if the component is already registered
//         if (!app.component(name)) {
//             app.component(name, defineAsyncComponent(() =>
//                 import(`./{name}.vue`)
//             ))
//         }
//     }
// }

let setup = () => {
    // WARNING: is called for each component instance
    // console.log('MyTest setup')
    // HACK: this is a hack to get the app instance
    if (data_store.default.pjs.app) {
        let app = data_store.default.pjs.app
        // check if the component is already registered
        if (!app.component('XpForm')) {
            app.component('XpForm', defineAsyncComponent(() =>
                import('./XpForm.vue')
            ))
        }
        if (!app.component('XpMap')) {
            app.component('XpMap', defineAsyncComponent(() =>
                import('./XpMap.vue')
            ))
        }
    }

}

let template = `
    <div>
        <h1>{{ store.h1 }}</h1>
        <p>{{ store.msg }}</p>
        <div>
            <hr />
            <label>
                <input type="checkbox" v-model="store.options.map" />
                <span>Map</span>
            </label>
            <label>
                <input type="checkbox" v-model="store.options.form_newsletter" />
                <span>Newsletter</span>
            </label>
            <label>
                <input type="checkbox" v-model="store.options.form_contact" />
                <span>Contact</span>
            </label>
            <hr />
        </div>
        <XpMap v-if="store.options.map" />
        <XpForm v-if="store.options.form_newsletter" name="newsletter" />
        <XpForm v-if="store.options.form_contact" name="contact" />
    </div>
`

    let computed = {
        store() {
            return data_store.default.store
        }
    }

    let data = {
    }

    export default {
        name: 'MyTest',
        setup,
        template,
        data: () => data,
        computed
    }