import { _ as __vitePreload, d as defineAsyncComponent } from './index-7fddaa5f.js';

let data_store = await __vitePreload(() => import('./index-7fddaa5f.js').then(n => n.m),true?["./index-7fddaa5f.js","./index-bf99ff62.css"]:void 0,import.meta.url);

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
        let app = data_store.default.pjs.app;
        // check if the component is already registered
        if (!app.component('XpForm')) {
            app.component('XpForm', defineAsyncComponent(() =>
                __vitePreload(() => import('./XpForm-d5e00f1b.js'),true?["./XpForm-d5e00f1b.js","./index-7fddaa5f.js","./index-bf99ff62.css","./XpForm-49be5755.css"]:void 0,import.meta.url)
            ));
        }
        if (!app.component('XpMap')) {
            app.component('XpMap', defineAsyncComponent(() =>
                __vitePreload(() => import('./XpMap-794c2594.js'),true?["./XpMap-794c2594.js","./index-7fddaa5f.js","./index-bf99ff62.css","./XpMap-c51ccf3b.css"]:void 0,import.meta.url)
            ));
        }
    }

};

let template = `
    <div>
        <h1>My Test</h1>
        <p>{{msg}}</p>
        <div>
            <button @click.prevent="store.counter++">Counter: {{store.counter}}</button>
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
`;

    let computed = {
        store() {
            return data_store.default.store
        }
    };

    let data = {
        msg: 'Hello World'
    };

    const MyTest = {
        name: 'MyTest',
        setup,
        template,
        data: () => data,
        computed
    };

export { MyTest as default };
