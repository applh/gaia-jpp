console.log('xp-plugin.js loaded')

export default {
  install: (app, options) => {

    // Plugin code goes here
    app.config.globalProperties.$xpio = (cmd, param, options = null) => {
      // console.log('xp', cmd, param, options)
      if (cmd == 'reverse') {
        return param.split('').reverse().join('')
      }
    }
    console.log('xp-plugin.js installed')

  }
}