// console.log('xp-plugin.js: loading...')

let xp_plugin = {
    install: (app, options) => {
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