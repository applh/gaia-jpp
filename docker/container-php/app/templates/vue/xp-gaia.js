// xp-gaia.js

import { defineAsyncComponent, reactive, defineCustomElement } from 'vue'

import XpApp from 'XpApp'
import XpMap from 'XpMap'
import XpForm from 'XpForm'
import XpCrud from 'XpCrud'
import XpcMarker from 'XpcMarker'
import XpcHud from 'XpcHud'

import XpTest from 'XpTest'


// forms
let form_contact = {
    name: 'contact',
    fields: [
        {
            name: 'name',
            type: 'text',
            label: 'Name',
            value: '',
            placeholder: 'Your name',
            required: true,
            minlength: 3,
            maxlength: 255,
        },
        {
            name: 'email',
            type: 'email',
            label: 'Email',
            value: '',
            placeholder: 'Your email',
            required: true,
            minlength: 3,
            maxlength: 255,
        },
        {
            name: 'message',
            type: 'textarea',
            label: 'Message',
            value: '',
            placeholder: 'Your message',
            required: true,
            minlength: 3,
            maxlength: 1024,
        },
    ],
}

let form_newsletter = {
    name: 'newsletter',
    fields: [
        {
            name: 'email',
            type: 'email',
            label: 'Email',
            value: '',
            placeholder: 'Your email',
            required: true,
            minlength: 3,
            maxlength: 255,
        },
        {
            name: 'name',
            type: 'text',
            label: 'Name',
            value: '',
            placeholder: 'Your name',
            required: true,
            minlength: 3,
            maxlength: 255,
        },
    ],
}

let form_register = {
    name: 'register',
    fields: [
        {
            name: 'email',
            type: 'email',
            label: 'Email',
            value: '',
            placeholder: 'Your email',
            required: true,
            minlength: 3,
            maxlength: 255,
        },
        {
            name: 'name',
            type: 'text',
            label: 'Name',
            value: '',
            placeholder: 'Your name',
            required: true,
            minlength: 3,
            maxlength: 255,
        },
        {
            name: 'password',
            type: 'password',
            label: 'Password',
            value: '',
            placeholder: 'Your password',
            required: true,
            minlength: 3,
            maxlength: 255,
        }
    ],
}
let form_login = {
    name: 'login',
    fields: [
        {
            name: 'email',
            type: 'email',
            label: 'Email',
            value: '',
            placeholder: 'Your email',
            required: true,
            minlength: 3,
            maxlength: 255,
        },
        {
            name: 'password',
            type: 'password',
            label: 'Password',
            value: '',
            placeholder: 'Your password',
            required: true,
            minlength: 3,
            maxlength: 255,
        }
    ],
}

let form_post = {
    name: 'post',
    fields: [
        {
            name: 'title',
            type: 'text',
            label: 'title',
            value: '',
            placeholder: 'Your title',
            required: true,
            minlength: 3,
            maxlength: 255,
        },
        {
            name: 'content',
            type: 'textarea',
            label: 'content',
            value: '',
            placeholder: 'Your content',
            required: true,
            minlength: 3,
            maxlength: 1024,
        },
    ],
}
// vue reactive
let vstore = reactive({
    tree_h: 200,
    tree_color: '#000000',
    tree_line_w: 1,
    map_marker_index: 0,
    app_title: 'Welcome to GAIA',
    counter: 0,
    message: 'Hello Vue!',
    ww: window.innerWidth,
    wh: window.innerHeight,
    user_api_key: '',
    admin_api_key: '',
    api_url: 'http://localhost:8666/api/json',
    user: {
        id: 0,
        posts: [
            {
                id: 1,
                title: 'Post 1',
                content: 'Post 1 content',
            },
            {
                id: 2,
                title: 'Post 2',
                content: 'Post 2 content',
            },
            {
                id: 3,
                title: 'Post 3',
                content: 'Post 3 content',
            },
            {
                id: 4,
                title: 'Post 4',
                content: 'Post 4 content',
            },
            {
                id: 5,
                title: 'Post 5',
                content: 'Post 5 content',
            },
            {
                id: 6,
                title: 'Post 6',
                content: 'Post 6 content',
            }
        ],
    },
    forms: {
        contact: form_contact,
        newsletter: form_newsletter,
        register: form_register,
        login: form_login,
        post: form_post,
    },
})

// not reactive
let store0 = {
    markers: [],
    markers_xpc: [],
    map_xpc: null,
}

// add window resize event listener
window.addEventListener('resize', () => {
    vstore.ww = window.innerWidth
    vstore.wh = window.innerHeight
})

export default {
    store0,
    vstore,
    install: (app, options) => {
        // Plugin code goes here
        console.log('installing plugin: xp-gaia.js')

        // define components
        app.component('XpApp', XpApp)
        app.component('XpMap', XpMap)
        app.component('XpCrud', XpCrud)
        app.component('XpForm', XpForm)

        // define async components
        let compos = [ 'XpAppUser', 'XpAppAdmin', 'XpAppDev', 'XpAppTest' ];
        
        compos.forEach(element => {
            app.component(element, defineAsyncComponent(() =>
                import(element)
            ))
        });

        // define custom elements
        let customs = {
            'xpc-marker': XpcMarker,
            'xpc-hud': XpcHud,
        }
        for (const [tag, compo] of Object.entries(customs)) {
            console.log('defining custom element', tag, compo)
            let custom = defineCustomElement(compo)
            customElements.define(tag, custom)
        }   
       

        // define directives
        app.config.globalProperties.$xpv = () => vstore;
        app.config.globalProperties.$xpv0 = () => store0;

        app.config.globalProperties.$xp = async (cmd, param = null, opts = null) => {
            // console.log('xp-gaia.js: $xp() called with cmd: ' + cmd)
            // warning: function is called at each render
            if (cmd == 'reverse') {
                return param.split('').reverse().join('')
            }
            if (cmd == 'logout') {
                vstore.user.id = 0
                vstore.user_api_key = ''
                vstore.admin_api_key = ''
                return
            }
            if (cmd == 'api/json') {
                let fd = new FormData()
                let request = param ?? {}

                request.user_api_key = vstore.user_api_key
                request.admin_api_key = vstore.admin_api_key
                
                let request_blob = new Blob([JSON.stringify(request)], { type: 'application/json' })
                fd.append('request', request_blob, 'request.json')

                let opts = {
                    method: 'POST',
                    body: fd,
                }
                let response = await fetch(vstore.api_url, opts)
                let json = await response.json()
                return json
            }
            if (cmd == 'posts') {
                // check if posts are already loaded
                if (vstore.posts) {
                    return vstore.posts
                }

                // FIXME: change the endpoint
                let response = await fetch('/api/scraps', {
                    method: 'GET',
                })
                let json = await response.json()
                // store posts in vstore
                vstore.posts = json
                return vstore.posts
            }

            return cmd;
        }


    }
}