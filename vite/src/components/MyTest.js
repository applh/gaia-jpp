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
        if (!app.component('XpGrid')) {
            app.component('XpGrid', defineAsyncComponent(() =>
                import('./XpGrid.vue')
            ))
        }
        if (!app.component('XpMap')) {
            app.component('XpMap', defineAsyncComponent(() =>
                import('./XpMap.vue')
            ))
        }
        if (!app.component('XpBuilder')) {
            app.component('XpBuilder', defineAsyncComponent(() =>
                import('./XpBuilder.vue')
            ))
        }
        if (!app.component('XpDraw')) {
            app.component('XpDraw', defineAsyncComponent(() =>
                import('./XpDraw.vue')
            ))
        }
    }

}


let template = `
    <div>
        <h1>{{ store.h1 }}</h1>
        <input v-model="store.msg" />
        <p>{{ $xp('reverse', store.msg) }}</p>
        <nav>
            <ul>
                <li v-for="m in menu1">{{ m }}</li>
            </ul>
        </nav>
        <div>
            <hr />
            <label>
                <input type="checkbox" v-model="store.options.grid" />
                <span>Grid</span>
            </label>
            <label>
                <input type="checkbox" v-model="store.options.map" />
                <span>Map</span>
            </label>
            <label>
                <input type="checkbox" v-model="store.options.builder" />
                <span>Builder</span>
            </label>
            <label>
                <input type="checkbox" v-model="store.options.draw" />
                <span>Draw</span>
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
        <XpGrid v-if="store.options.grid" />
        <XpForm v-if="store.options.form_newsletter" name="newsletter" />
        <XpForm v-if="store.options.form_contact" name="contact" />
        <XpBuilder v-if="store.options.builder" name="builder" />
        <XpDraw v-if="store.options.draw" name="draw" />
    </div>
`

    let computed = {
        store() {
            return data_store.default.store
        }
    }

    let data = {
        menu1: [ 'Pages', 'Posts', 'Parts', 'Templates', 'Groups', 'Users', 'Settings' ],
    }

    export default {
        name: 'MyTest',
        setup,
        template,
        data: () => data,
        computed
    }