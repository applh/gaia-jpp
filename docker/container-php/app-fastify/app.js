'use strict'

const fs = require('fs')
const path = require('path')
const AutoLoad = require('@fastify/autoload')
const fastifySqlite = require('fastify-sqlite')

// Pass --options via CLI arguments in command to enable these options.
module.exports.options = {}

module.exports = async function (fastify, opts) {
    // Place here your custom code!

    // Do not touch the following lines

    // This loads all plugins defined in plugins
    // those should be support plugins that are reused
    // through your application
    fastify.register(AutoLoad, {
        dir: path.join(__dirname, 'plugins'),
        options: Object.assign({}, opts)
    })

    // This loads all plugins defined in routes
    // define your routes in one of these
    fastify.register(AutoLoad, {
        dir: path.join(__dirname, 'routes'),
        options: Object.assign({}, opts)
    })

    console.error('DIRNAME', __dirname)
    // get the current directory
    let curdir = __dirname
    let path_db = path.join(__dirname, '/db-users.sqlite')
    // check if file exists
    if (!fs.existsSync(path_db)) {
        // log error
        // console.error('ERROR: file does not exist: ' + path_db)
        // try another path
        path_db = path.join(__dirname, 'var/www/html/db-users.sqlite')
        // console.log('Trying another path: ' + path_db)
    }

    fastify.register(fastifySqlite, {
        dbFile: path_db,
    })

    // get port from environment variable
    let port = process.env.PORT || 3000
    console.log('PORT', port)
    let dsn = process.env.DSN || 'mysql://root:mydbroot@mydbhost/app-php'
    // local mysql server with npm start could be 
    // DSN=mysql://root:root@127.0.0.1:3306/app-php npm start

    console.log('DSN', dsn)
    fastify.register(require('@fastify/mysql'), {
        connectionString: dsn
      })
}
