import { _ as __vitePreload, d as defineAsyncComponent } from './index-b6dfd5b9.js';

let data_store = await __vitePreload(() => import('./index-b6dfd5b9.js').then(n => n.p),true?["./index-b6dfd5b9.js","./index-bf99ff62.css"]:void 0,import.meta.url);

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
                __vitePreload(() => import('./XpForm-4d542977.js'),true?["./XpForm-4d542977.js","./index-b6dfd5b9.js","./index-bf99ff62.css","./XpForm-a224c341.css"]:void 0,import.meta.url)
            ));
        }
        if (!app.component('XpMap')) {
            app.component('XpMap', defineAsyncComponent(() =>
                __vitePreload(() => import('./XpMap-6bd4c306.js'),true?["./XpMap-6bd4c306.js","./index-b6dfd5b9.js","./index-bf99ff62.css","./XpMap-204e3752.css"]:void 0,import.meta.url)
            ));
        }
    }

};

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
`;

    let computed = {
        store() {
            return data_store.default.store
        }
    };

    let data = {
    };

    const MyTest = {
        name: 'MyTest',
        setup,
        template,
        data: () => data,
        computed
    };

export { MyTest as default };
