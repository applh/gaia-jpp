let data_store = await import('./data-store.js') 

// console.log('data_store', data_store)

let template = `
    <div>
        <h1>My Test</h1>
        <p>{{msg}}</p>
        <button @click.prevent="store.counter++">Counter: {{store.counter}}</button>
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
    template,
    data: () => data,
    computed
}