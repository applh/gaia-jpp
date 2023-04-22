import { _ as __vitePreload, a as defineAsyncComponent } from './index-34d38590.js';

let data_store = await __vitePreload(() => import('./index-34d38590.js').then(n => n.G),true?["./index-34d38590.js","./index-2e2dcb74.css"]:void 0,import.meta.url);
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
                __vitePreload(() => import('./XpForm-fe314cbd.js'),true?["./XpForm-fe314cbd.js","./index-34d38590.js","./index-2e2dcb74.css","./_plugin-vue_export-helper-c4c0bc37.js","./XpForm-a224c341.css"]:void 0,import.meta.url)
            ));
        }
        if (!app.component('XpMap')) {
            app.component('XpMap', defineAsyncComponent(() =>
                __vitePreload(() => import('./XpMap-956ccd0e.js'),true?["./XpMap-956ccd0e.js","./index-34d38590.js","./index-2e2dcb74.css","./_commonjsHelpers-849bcf65.js","./_plugin-vue_export-helper-c4c0bc37.js","./XpMap-505d9d9b.css"]:void 0,import.meta.url)
            ));
        }
        if (!app.component('XpBuilder')) {
            app.component('XpBuilder', defineAsyncComponent(() =>
                __vitePreload(() => import('./XpBuilder-dc1de1ab.js'),true?["./XpBuilder-dc1de1ab.js","./index-34d38590.js","./index-2e2dcb74.css","./index-da9c79b5.js","./_commonjsHelpers-849bcf65.js"]:void 0,import.meta.url)
            ));
        }
        if (!app.component('XpDraw')) {
            app.component('XpDraw', defineAsyncComponent(() =>
                __vitePreload(() => import('./XpDraw-c204e183.js'),true?["./XpDraw-c204e183.js","./index-34d38590.js","./index-2e2dcb74.css","./index-da9c79b5.js","./_plugin-vue_export-helper-c4c0bc37.js","./XpDraw-2377def5.css"]:void 0,import.meta.url)
            ));
        }
    }

};

let template = `
    <div>
        <h1>{{ store.h1 }}</h1>
        <input v-model="store.msg" />
        <p>{{ $xp('reverse', store.msg) }}</p>
        <div>
            <hr />
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
    };

    const MyTest = {
        name: 'MyTest',
        setup,
        template,
        data: () => data,
        computed
    };

export { MyTest as default };
