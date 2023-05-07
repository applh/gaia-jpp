// xp-gaia.js

import { defineAsyncComponent, reactive } from 'vue'

import XpApp from 'XpApp'
import XpTest from 'XpTest'

// vue reactive
let vstore = reactive({
    counter: 0,
    message: 'Hello Vue!',
    ww: window.innerWidth,
    wh: window.innerHeight,
    user_api_key: '',
    admin_api_key: '',
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
})

// not reactive
let store0 = {
}

// add window resize event listener
window.addEventListener('resize', () => {
    vstore.ww = window.innerWidth
    vstore.wh = window.innerHeight
})

export default {
    install: (app, options) => {
        // Plugin code goes here
        console.log('installing plugin: xp-gaia.js')

        // define components
        app.component('XpApp', XpApp)

        // define async components
        let compos = [ 'XpAppUser', 'XpAppAdmin', 'XpAppDev', 'XpAppTest' ];
        
        compos.forEach(element => {
            app.component(element, defineAsyncComponent(() =>
                import(element)
            ))
        });

        app.config.globalProperties.$xpv = () => vstore;

        app.config.globalProperties.$xp = (cmd, param = null, opts = null) => {
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
            return cmd;
        }
    }
}