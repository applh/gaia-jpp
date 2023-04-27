// load vue js
let vue = await import("/wp-json/xp-studio/v1/media?src=vue.esm-browser.prod.js");
let xp_plugin = await import("/wp-json/xp-studio/v1/media?src=xp-plugin.js");
// create app

let template = `
<div>
    <h1>XP Studio</h1>
    <form @submit.prevent="act_submit">
        <input type="text" name="m" v-model="api_m">
        <textarea name="content" v-model="api_content"></textarea>
        <button type="submit">Submit</button>
    </form>
    <div>admin api key: {{ admin_key }}</div>
    <div>{{ message }}</div>
    <div>{{ $xpio('reverse', api_content) }}</div>
</div>
`

let created = function () {
    // get the attribute data-xp-admin-key from #app
    this.admin_key = document.querySelector('#app').getAttribute('data-xp-admin-key')
}

let methods = {
    act_submit: async function ($event) {
        console.log('act_submit', $event.target)
        let form_data = new FormData()
        form_data.append('xp_key', this.admin_key)
        form_data.append('m', this.api_m)
        // put api_content in a Blob
        let blob = new Blob([this.api_content], { type: 'application/json' })
        form_data.append('task_json', blob, 'task.json')

        let response = await fetch('/wp-json/xp-studio/v1/json', {
            method: 'POST',
            headers: {
                'X-XP-Admin-Key': this.admin_key
            },
            body: form_data
        })
        let data = await response.json()
        console.log('data', data)
    }
}

const app = vue.createApp({
    template,
    data: function () {
        return {
            admin_key: '',
            api_m: '',
            api_content: '',
            message: "Hello Vue!"
        }
    },
    methods,
    created,
});
app.use(xp_plugin.default);
// mount app
app.mount("#app");
