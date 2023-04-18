
let { createApp, defineCustomElement } = await import('./vue.esm-browser.prod.js')

console.log('Hello from gaia-jpp/wp/media/vue-app.js')

// define custom elements
// https://vuejs.org/api/general.html#definecustomelement
// separate import for each custom element
let mod_store = await import('./vue-store.js')
let mod_xp_box = await import('./xp-box.js')

// BETTER PERFORMANCE: 
// define custom elements inline
// let xp_box = {
//     name: 'xp-box',
//     template: `
//         <h1>XP Box</h1>
//     `,
// }

let ce_xp_box = defineCustomElement(mod_xp_box.default)
customElements.define('xp-box', ce_xp_box)

let appBox = document.getElementById('app')
console.log('appBox', appBox)
if (appBox) {
    let data = {
        msg: 'Hello from Vue!'
    }
    let template = `
        <div>
{{ msg }}
        </div>
    `

    createApp({
        template: template,
        data: () => data,
    }).mount(appBox)
}