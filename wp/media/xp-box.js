console.log('Hello from gaia-jpp/wp/media/xp-box.js')
let mod_store = await import('./vue-store.js')

let template = `
    <div>
        <h3>XP Box</h3>
        <button @click="store.counter++">{{ store.counter }}</button>
    </div>
`

let computed = {
    store () {
        return mod_store.default.data
    }
}

export default {
    name: 'xp-box',
    template,
    computed,
}