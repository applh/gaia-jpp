'use strict'


module.exports = async function (fastify, opts) {
    fastify.get('/', async function (request, reply) {
        let limit = Math.floor(request.query.limit || 1000)
        // compute execution time
        let start = new Date()
        fastify.sqlite.all('SELECT * FROM news ORDER BY id DESC LIMIT ' + limit, (err, rows) => {
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
                data: rows
            }

            reply.send(results)
        })

        return reply
    })
}
