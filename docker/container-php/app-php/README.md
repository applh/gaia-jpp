# PHP vs Node Fastify

## SQLITE

* SQLite DB has a table with about 60.000 rows

### Setup 

4 differents setups on the same SQLite DB

* Node Fastify with fastify-sqlite, 
  * http://fastify-localhost:3000

* PHP with PDO
  * http://php-localhost:3666
  * with PHP built-in server 

* Node Fastify with fastify-sqlite, 
  * http://fastify.test:8666
  * inside Docker containers
  * with Nginx and Reverse Proxy 

* PHP with PDO
  * http://app2:test:8666
  * inside Docker containers
  * with Nginx and PHP-FPM 


### Commands


* localhost PHP

```
php -S php-localhost.test:3666
```

* localhost Node Fastify

```
npm run dev

npm start

```

* Docker

```
docker-compose build
docker-compose up -d
```

### Performances 

About 10-15 ms per query to read 1000 rows
* with ORDER BY id DESC
* table about 60.000 rows

### Comparison between Fastify and PHP

#### 100 rows

![Alt text](test/100rows.png)

#### 200 ROWS

![Alt text](test/200rows.png)

#### 400 ROWS

![Alt text](test/400rows.png)


#### 800 ROWS

![Alt text](test/800rows.png)

#### 1600 ROWS

![Alt text](test/1600rows.png)

#### 3200 ROWS

![Alt text](test/3200rows.png)

