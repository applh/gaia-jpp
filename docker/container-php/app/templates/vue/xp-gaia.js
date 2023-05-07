// xp-gaia.js

import { defineAsyncComponent, reactive } from 'vue'

import XpApp from 'XpApp'

import XpTest from 'XpTest'

// vue reactive
let vstore = reactive({
    counter: 0,
    message: 'Hello Vue!',
})

// not reactive
let store0 = {
}

export default {
    install: (app, options) => {
        // Plugin code goes here
        console.log('installing plugin: xp-gaia.js')

        app.component('XpTest0', {
            template: `<h1>XP Test 0</h1>`
        })

        // define components
        app.component('XpApp', XpApp)
        app.component('XpTest', XpTest)
        // define async components
        app.component('XpTestAsync', defineAsyncComponent(() =>
            import('XpTestAsync')
        ))

        app.config.globalProperties.$xpv = () => vstore;

        app.config.globalProperties.$xp = (cmd, param = null, opts = null) => {
            // console.log('xp-gaia.js: $xp() called with cmd: ' + cmd)
            // warning: function is called at each render
            if (cmd == 'reverse') {
                return param.split('').reverse().join('')
            }
            return cmd;
        }
    }
}