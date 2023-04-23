# WORDPRESS

* TODO:
* customize PHP-SQL container
* download latest wordpress version from
  * https://wordpress.org/latest.zip
* unzip the archive and rename to my-wordpress
* change the docker-compose.yml file to mount the my-wordpress folder
* create a folder my-plugin and change the docker-compose.yml file to mount the my-plugin folder
* create file my-plugin/index.php

```php
<?php    
/**
 * Plugin Name: My Plugin
 */

```
* run the container and install WP

## FIXME: PROBLEMS AFTER WP INSTALL 

* WP server requests are not working as URLs are not with the right port
  * should customize the nginx.conf file to sync port ?


## DOCKER: docker-compose.yml

* Note: PHP-FPM official image is running on Debian
* Note: MariaDB official image is running on Ubuntu
* Crazy 😱: Adminer can be a docker service
  *  ...just to run one PHP file 😅


### docker-compose.yml

```yml
version: "3.9"

services:
    mydbhost:
        # We use a mariadb image which supports both amd64 & arm64 architecture
        image: mariadb:latest
        # If you really want to use MySQL, uncomment the following line
        #image: mysql:8.0.27
        command: '--default-authentication-plugin=mysql_native_password'
        volumes:
            - db_data:/var/lib/mysql
        restart: always
        environment:
            - MYSQL_DATABASE=mydb
            - MYSQL_USER=mydbuser
            - MYSQL_PASSWORD=mydbpassword
            - MYSQL_ROOT_PASSWORD=mydbroot
        expose:
            - 3306
            - 33060
    web:
        image: nginx:latest
        ports:
            - "8555:80"
        volumes:
            - www_data:/var/www
            - ./app:/var/www/html
            - ./nginx.conf:/etc/nginx/conf.d/default.conf
        restart: always
        links:
            - php-fpm
    php-fpm:
        build: ../image-php-fpm
        volumes:
            - ./app:/var/www/html
        restart: always
    adminer:
        image: adminer:latest
        restart: always
        ports:
            - 8554:8080
volumes:
    db_data:
    www_data:

```

## PHP: PDO

* WARNING: with DOCKER, the host is the name of the container, not localhost

```php

    $pdo = new PDO('mysql:dbname=mydb;host=mydbhost', 'mydbuser', 'mydbpassword');

```

## PHP: ADMINER

Adminer is a full-featured database management tool written in PHP. Conversely to phpMyAdmin, it consist of a single file ready to deploy to the target server. Adminer is available for MySQL, PostgreSQL, SQLite, MS SQL, Oracle, Firebird, SimpleDB, Elasticsearch and MongoDB.

So with a PHP server ready, you can just copy the adminer.php file to your server and start using it.

* Crazy 😱: Docker is providing a container with Adminer, so you can install another docker service just to run one PHP file.

## SQL: MARIADB


### TESTS

create a table geocms (if not exists) with columns: 
* id, title, description, lat, lng, created_at, updated_at

```sql

CREATE TABLE IF NOT EXISTS `geocms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


```

insert 10 rows

```sql

INSERT INTO `geocms` (`id`, `title`, `description`, `lat`, `lng`, `created_at`, `updated_at`) VALUES
(1, 'title 1', 'description 1', 48.856614, 2.3522219, '2021-09-01 00:00:00', '2021-09-01 00:00:00'),
(2, 'title 2', 'description 2', 48.856614, 2.3522219, '2021-09-01 00:00:00', '2021-09-01 00:00:00'),
(3, 'title 3', 'description 3', 48.856614, 2.3522219, '2021-09-01 00:00:00', '2021-09-01 00:00:00'),
(4, 'title 4', 'description 4', 48.856614, 2.3522219, '2021-09-01 00:00:00', '2021-09-01 00:00:00'),
(5, 'title 5', 'description 5', 48.856614, 2.3522219, '2021-09-01 00:00:00', '2021-09-01 00:00:00'),
(6, 'title 6', 'description 6', 48.856614, 2.3522219, '2021-09-01 00:00:00', '2021-09-01 00:00:00'),
(7, 'title 7', 'description 7', 48.856614, 2.3522219, '2021-09-01 00:00:00', '2021-09-01 00:00:00'),
(8, 'title 8', 'description 8', 48.856614, 2.3522219, '2021-09-01 00:00:00', '2021-09-01 00:00:00'),
(9, 'title 9', 'description 9', 48.856614, 2.3522219, '2021-09-01 00:00:00', '2021-09-01 00:00:00'),
(10, 'title 10', 'description 10', 48.856614, 2.3522219, '2021-09-01 00:00:00', '2021-09-01 00:00:00');

```
