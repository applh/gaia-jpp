import { _ as __vitePreload, d as defineAsyncComponent } from './index-f3f79557.js';

let data_store = await __vitePreload(() => import('./index-f3f79557.js').then(n => n.l),true?["./index-f3f79557.js","./index-d5cd5ee5.css"]:void 0,import.meta.url);

// console.log('data_store', data_store)

let setup = () => {
    // WARNING: is called for each component instance
    console.log('MyTest setup');

    // HACK: this is a hack to get the app instance
    if (data_store.default.pjs.app) {
        let app = data_store.default.pjs.app;
        // check if the component is already registered
        if (!app.component('XpForm')) {
            app.component('XpForm', defineAsyncComponent(() =>
                __vitePreload(() => import('./XpForm-9f65cabe.js'),true?["./XpForm-9f65cabe.js","./index-f3f79557.js","./index-d5cd5ee5.css","./XpForm-d7096932.css"]:void 0,import.meta.url)
            ));
        }
    }
};

let template = `
    <div>
        <h1>My Test</h1>
        <p>{{msg}}</p>
        <button @click.prevent="store.counter++">Counter: {{store.counter}}</button>
        <XpForm />
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
