import { defineAsyncComponent } from 'vue'


let data_store = await import('./data-store.js')

// console.log('data_store', data_store)

let setup = () => {
    // WARNING: is called for each component instance
    console.log('MyTest setup')

    // HACK: this is a hack to get the app instance
    if (data_store.default.pjs.app) {
        let app = data_store.default.pjs.app
        // check if the component is already registered
        if (!app.component('XpForm')) {
            app.component('XpForm', defineAsyncComponent(() =>
                import('./XpForm.vue')
            ))
        }
    }
}

let template = `
    <div>
        <h1>My Test</h1>
        <p>{{msg}}</p>
        <button @click.prevent="store.counter++">Counter: {{store.counter}}</button>
        <XpForm />
    </div>
`

    let computed = {
        store() {
            return data_store.default.store
        }
    }

    let data = {
        msg: 'Hello World'
    }

    export default {
        name: 'MyTest',
        setup,
        template,
        data: () => data,
        computed
    }