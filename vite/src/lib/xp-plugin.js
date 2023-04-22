// console.log('xp-plugin.js: loading...')
import { pjs } from '../components/data-store.js'

let xp_plugin = {
    install: (app, options) => {
        // HACK: to publish the app instance
        pjs.app = app

        // inject a globally available $xp() method
        app.config.globalProperties.$xp = (cmd='', key={}) => {
            let res = null
            if (cmd == 'reverse') {
                res = key.split('').reverse().join('')
            }
            return res
        }
    }
}

export { xp_plugin }