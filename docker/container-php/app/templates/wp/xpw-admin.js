import { defineAsyncComponent, reactive, defineCustomElement } from 'vue'

// load json data isnide template#app-json
let store = {}
let json = document.querySelector('#app-json')
if (json) {
    store = JSON.parse(json.innerHTML)
}

console.log('store', store)


let data_tree = [
    {
        label: 'Modules',
        children: [
            {
                label: 'SEO',
            },
            {
                label: 'Forms',
            },
            {
                label: 'Cache',
            },
            {
                label: 'CMS',
            },
            {
                label: 'Domains',
            },
            {
                label: 'Backup',
            },
            {
                label: 'Visits',
            },
        ]
    },
    {
        label: 'Sites',
        children: [
            {
                label: 'my-site.com',
                children: [{
                    label: 'Pages'
                }]
            },
            {
                label: 'my-site2.com',
                children: [{
                    label: 'Pages'
                }]
            },
            {
                label: 'my-site3.com',
                children: [{
                    label: 'Pages'
                }]
            },
        ]
    },
    {
        label: 'Infos',
        children: [
            {
                label: '01 - January',
            },
            {
                label: '02 - February',
            },
            {
                label: '03 - March',
            },
            {
                label: '04 - April',
            },
            {
                label: '05 - May',
            },
            {
                label: '06 - June',
            },
            {
                label: '07 - July',
            },
            {
                label: '08 - August',
            },
            {
                label: '09 - September',
            },
            {
                label: '10 - October',
            },
            {
                label: '11 - November',
            },
            {
                label: '12 - December',
            },
        ]    },
    {
        label: 'Archives',
        children: [
            {
                label: '01 - January',
            },
            {
                label: '02 - February',
            },
            {
                label: '03 - March',
            },
            {
                label: '04 - April',
            },
            {
                label: '05 - May',
            },
            {
                label: '06 - June',
            },
            {
                label: '07 - July',
            },
            {
                label: '08 - August',
            },
            {
                label: '09 - September',
            },
            {
                label: '10 - October',
            },
            {
                label: '11 - November',
            },
            {
                label: '12 - December',
            },
        ]
    },
]

let restore = reactive({
    data_tree,
    form: {
        title: 'My Title',
        code: 'My Code',
    }
});

export default {
    store,
    install: (app, options) => {
        console.log('install', options)
        app.config.globalProperties.$store = () => store;
        app.config.globalProperties.$restore = () => restore;

        // send api request and get json response
        app.config.globalProperties.$api = async function () {
            let url = '/api/wp';
            // add form data
            let form = restore.form;
            // convert to json
            let json_request = JSON.stringify(form);
            // convert to blob
            let blob = new Blob([json_request], {
                type: 'application/json'
            });
            // create form data
            let form_data = new FormData();
            // append blob
            form_data.append('request_json', blob, 'request_json');

            
            // send request
            let response = await fetch(url, {
                method: 'POST',
                body: form_data,
            });
            let data = await response.json();
            return data;
        };

    }
}
