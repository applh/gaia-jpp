const http = require('http');

const hostname = '127.0.0.1';
const port = 3333;


const sqlite3 = require('sqlite3').verbose();


const db = new sqlite3.Database('my-db-news.sqlite');
const server = http.createServer((req, res) => {
    console.log(req.url);

    // extract get parameters from url
    let url = req.url.split('?')[0];
    console.log(url);
    let params = req.url.split('?')[1];
    console.log(params);
    let paramsObj = {};
    if (params) {
        params.split('&').forEach((param) => {
            let key = param.split('=')[0];
            let value = param.split('=')[1];
            paramsObj[key] = value;
        });
    }
    // get limit GET parameter
    let limit = paramsObj?.limit || 1000;

    db.serialize(() => {
        db.all("SELECT * FROM news ORDER BY id DESC limit " + limit, (err, rows) => {
            res.setHeader('Content-Type', 'application/json');

            let now = new Date();
            let json = JSON.stringify({
                now: now,
                limit,
                total: rows.length,
                data: rows
            });
            res.statusCode = 200;    
            res.end(json);
        });
    });

    // db.close();    

});

server.listen(port, hostname, () => {
    console.log(`Server running at http://${hostname}:${port}/`);
});

