import { _ as __vitePreload } from './index-80c7bd63.js';

let data_store = await __vitePreload(() => import('./data-store-cd608a39.js'),true?["./data-store-cd608a39.js","./index-80c7bd63.js","./index-b2997a0f.css"]:void 0,import.meta.url); 

// console.log('data_store', data_store)

let template = `
    <div>
        <h1>My Test</h1>
        <p>{{msg}}</p>
        <button @click.prevent="store.counter++">Counter: {{store.counter}}</button>
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
    template,
    data: () => data,
    computed
};

export { MyTest as default };
