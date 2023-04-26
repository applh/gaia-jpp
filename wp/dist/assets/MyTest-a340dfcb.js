import { _ as __vitePreload, a as defineAsyncComponent } from './index-fbbdd6e6.js';

let data_store = await __vitePreload(() => import('./index-fbbdd6e6.js').then(n => n.a8),true?["./index-fbbdd6e6.js","./index-06122cba.css"]:void 0,import.meta.url);
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
        let app = data_store.default.pjs.app;
        // check if the component is already registered
        if (!app.component('XpForm')) {
            app.component('XpForm', defineAsyncComponent(() =>
                __vitePreload(() => import('./XpForm-eadde45c.js'),true?["./XpForm-eadde45c.js","./index-fbbdd6e6.js","./index-06122cba.css","./_plugin-vue_export-helper-c4c0bc37.js","./XpForm-a224c341.css"]:void 0,import.meta.url)
            ));
        }
        if (!app.component('XpGrid')) {
            app.component('XpGrid', defineAsyncComponent(() =>
                __vitePreload(() => import('./XpGrid-94e576ab.js'),true?["./XpGrid-94e576ab.js","./index-fbbdd6e6.js","./index-06122cba.css","./XpForm-eadde45c.js","./_plugin-vue_export-helper-c4c0bc37.js","./XpForm-a224c341.css","./XpMap-150ebc87.js","./_commonjsHelpers-849bcf65.js","./XpMap-505d9d9b.css","./XpGrid-d568fdf4.css"]:void 0,import.meta.url)
            ));
        }
        if (!app.component('XpMap')) {
            app.component('XpMap', defineAsyncComponent(() =>
                __vitePreload(() => import('./XpMap-150ebc87.js'),true?["./XpMap-150ebc87.js","./index-fbbdd6e6.js","./index-06122cba.css","./_commonjsHelpers-849bcf65.js","./_plugin-vue_export-helper-c4c0bc37.js","./XpMap-505d9d9b.css"]:void 0,import.meta.url)
            ));
        }
        if (!app.component('XpBuilder')) {
            app.component('XpBuilder', defineAsyncComponent(() =>
                __vitePreload(() => import('./XpBuilder-b098afc9.js'),true?["./XpBuilder-b098afc9.js","./index-fbbdd6e6.js","./index-06122cba.css","./index-9fd04d19.js","./_commonjsHelpers-849bcf65.js"]:void 0,import.meta.url)
            ));
        }
        if (!app.component('XpDraw')) {
            app.component('XpDraw', defineAsyncComponent(() =>
                __vitePreload(() => import('./XpDraw-64a38088.js'),true?["./XpDraw-64a38088.js","./index-fbbdd6e6.js","./index-06122cba.css","./_plugin-vue_export-helper-c4c0bc37.js","./index-9fd04d19.js","./XpDraw-2377def5.css"]:void 0,import.meta.url)
            ));
        }
    }

};


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
`;

    let computed = {
        store() {
            return data_store.default.store
        }
    };

    let data = {
        menu1: [ 'Pages', 'Posts', 'Parts', 'Templates', 'Groups', 'Users', 'Settings' ],
    };

    const MyTest = {
        name: 'MyTest',
        setup,
        template,
        data: () => data,
        computed
    };

export { MyTest as default };
