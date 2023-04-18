let { reactive} = await import('./vue.esm-browser.prod.js')

let data = reactive({
    msg: 'Hello from Vue!',
    counter: 0,
})

export default {
    data
}
