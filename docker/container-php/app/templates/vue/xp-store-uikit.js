import { defineAsyncComponent, reactive, defineCustomElement } from 'vue'

console.log('XpStoreUiKit: loading...')


let forms = {
    // 'contact': {
    //     title: 'Contact Us',
    //     name: 'contact',
    //     fields: [
    //         { name: 'name', type: 'text', label: 'Name', value: '' },
    //         { name: 'email', type: 'email', label: 'Email', value: '' },
    //         { name: 'message', type: 'textarea', label: 'Message', value: '' },
    //     ],
    // },
    // 'newsletter': {
    //     title: 'Newsletter',
    //     name: 'newsletter',
    //     fields: [
    //         { name: 'name', type: 'text', label: 'Name', value: '' },
    //         { name: 'email', type: 'email', label: 'Email', value: '' },
    //     ],
    // },
}

let storer = reactive({
    name: 'xp-store-uikit',
    counter: 0,
    forms,
})

let form_load = async function (name) {
    // if already loaded in storer, return it
    if (storer.forms[name]) {
        return storer.forms[name]
    }
    // else load it from server
    let url = `/api/forms`
    let json = await xp_fetch(url, {
        class: 'form',
        method: 'load',
        name: name,
    })
    storer.forms[name] = json?.forms[name] ?? null
    return storer.forms[name]
}

let xp_fetch = async function (url, params) {

    // make blob
    let request_json = JSON.stringify(params)
    let blob = new Blob([request_json], { type: 'application/json' })

    let fd = new FormData()
    fd.append('request_json', blob, 'request.json')
    let res = await fetch(url, {
        method: 'POST',
        body: fd,
    })
    let json = await res.json()
    return json
}

// register custom element xp-form
// https://vuejs.org/guide/extras/web-components.html#using-custom-elements-in-vue
const CeForm = defineCustomElement({
    template: `
        <div class="ce-form">
            <form v-if="form" @submit.prevent="act_submit">
                <h1>{{ form?.title }}</h1>
                <label v-for="f in form.fields">
                    <span>{{ f.label }}</span>
                    <textarea v-if="f.type=='textarea'" :name="f.name" rows="10" v-model="f.value"></textarea>
                    <input v-else :type="f.type" :name="f.name" :value="f.value" v-model="f.value" />
                </label>
                <button type="submit">Send</button>
                <div class="feedback">{{ form?.feedback ?? '...' }}</div>
            </form>
        </div>
    `,
    props: {
        name: {
            type: String,
            default: 'contact',
        }
    },
    data: () => ({
        form: null,
    }),
    computed: {
        $vs: () => storer
    },
    methods: {
        async act_submit() {
            // console.log('submit', this.form)
            // else load it from server
            let url = `/api/forms`
            let json = await xp_fetch(url, {
                class: 'form',
                method: 'submit',
                form: this.form,
            })
            // console.log('json', json)
            let form = json?.forms[this.form.name] ?? null
            if (form?.feedback) {
                this.form = form
            }
        }
    },
    async created() {
        this.form = await form_load(this.name)
    },
    styles: [
        `* { box-sizing: border-box; font-size: 1rem}`,
        `.ce-form form { border: 1px solid red; display: grid; grid-template-columns: 1fr; grid-gap: 1rem; padding: 1rem; }`,
        `h1 { color: red; text-align: center; }`,
        `input, textarea { width: 100%; padding: 1rem; }`,
        `button { background-color: red; color: white; padding: 1rem; }`
    ]
})
customElements.define('ce-form', CeForm)

// declare global properties
export default {
    install: (app, options) => {

        // register async component xp-form
        app.component('xp-form', defineAsyncComponent(() =>
            import('XpForm')
        ))


        // add global properties
        app.config.globalProperties.$xp = (cmd = '') => {
            return cmd + ' from xp-store-uikit.js'
        }

        app.config.globalProperties.$storer = () => storer

    }
}