'use strict'


module.exports = async function (fastify, opts) {
    fastify.get('/', async function (request, reply) {
        let limit = Math.floor(request.query.limit || 1000)
        // compute execution time
        let start = new Date()
        let oups = Math.floor(Math.random() * 100000)
        fastify.sqlite.all("SELECT * FROM news WHERE id NOT IN ('" + oups + "') ORDER BY id DESC LIMIT " + limit, 
            (err, rows) => {
                if (err) {
                    console.error(err)
                    return
                }
                // compute execution time
                let end = new Date() - start
                // console.log('Execution time: %d ms', end)

                // console.log(rows)
                let results = {
                    now: start,
                    limit,
                    duration: end,
                    oups,
                    data: rows
                }

            reply.send(results)
        })

        return reply
    })

    fastify.get('/sql-yes-json-no', async function (request, reply) {
        let limit = Math.floor(request.query.limit || 1000)
        // compute execution time
        let start = new Date()
        let oups = Math.floor(Math.random() * 100000)
        fastify.sqlite.all("SELECT * FROM news WHERE id NOT IN ('" + oups + "') ORDER BY id DESC LIMIT " + limit, 
            (err, rows) => {
                if (err) {
                    console.error(err)
                    return
                }
                // compute execution time
                let end = new Date() - start
                // console.log('Execution time: %d ms', end)

                // console.log(rows)
                let results = {
                    now: start,
                    limit,
                    duration: end,
                    oups,
                    // data: rows
                }

            reply.send(results)
        })

        return reply
    })

    fastify.get('/base', async function (request, reply) {
        let limit = Math.floor(request.query.limit || 1000)
        // compute execution time
        let start = new Date()
        let oups = Math.floor(Math.random() * 100000)
        return {
            now: start,
            oups,
        }
    })
}
