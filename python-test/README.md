# Benchmark

## PHP + MySQL

* Performances are degrading when the number of SQL requests increases for only one page
* 10-20  SQL requests per page is a good number
  * Docker+Nginx+Php+MariaDB is rather stable
  * (typically going from 10ms to 20ms per page as rows are from 100 to 3200)
* 30+ SQL requests per page can be a problem
  * Docker mariadb is rather stable (in slowing down regularly)
  * local MySQL is not stable and loosing performance rapidly if data volume is also important ?! 
    * FIXME: improve local MySQL settings ?

## CHARTS

### 100 rows

![Alt text](img/100rows.png)

### 200 rows

![Alt text](img/200rows.png) 

### 400 rows

![Alt text](img/400rows.png) 

### 800 rows

![Alt text](img/800rows.png) 

* note: local MySQL is not stable and loosing performance rapidly if data volume is also important ?!
* Docker mariadb is rather stable (in slowing down regularly)

### 1600 rows

![Alt text](img/1600rows.png) 

* Note: local MySQL is not stable and loosing performance rapidly if data volume is also important ?!

### 3200 rows

![Alt text](img/3200rows.png)

* Note: local MySQL is not stable and loosing performance rapidly if data volume is also important ?!


## CHARTS / SQLITE

* With SQLite, PHP is always better than Fastify
  * localhost
  * Docker
    * DDev is about the same as localhost + Fastify (surprising...😱😎)
    * (DDev is containers Nginx + PHP)
    * TODO: check DDev + Fastify ?

![Alt text](img-sqlite/100rows.png) 
![Alt text](img-sqlite/200rows.png) 
![Alt text](img-sqlite/400rows.png) 
![Alt text](img-sqlite/800rows.png) 
![Alt text](img-sqlite/1600rows.png) 
![Alt text](img-sqlite/3200rows.png)