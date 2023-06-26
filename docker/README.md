# DOCKER PHP+NGINX

## INSTALLATION

### Docker: Main development

* Pre-requisites
  * install Docker
    * https://docs.docker.com/engine/install/
  * install Docker Compose
    * https://docs.docker.com/compose/install/

The main application is currently in the folder `docker/container-php`
* go to [docker/container-php](docker/container-php/)

The source code is mostly in the folder `app`

```bash
cd docker/container-php
docker-compose up -d

```

* Note: `-d` means "detached mode".
  * So the command will launch as a `daemon` at each system startup.

### Docker: WordPress

* Prerequisites
  * install `wp-env`
  * https://developer.wordpress.org/block-editor/packages/packages-env/
  
from the folder `docker/container-php`
  * (technically, the folder where the file .wp-env.json is located)
  * launch the command `wp-env start`

```bash
cd docker/container-php
wp-env start
```

## TUTO

## LAUNCH

```bash
docker ps

docker-compose build

docker-compose up

docker-compose up -d

docker-compose up --detach

docker-compose down

docker-compose stop

docker-compose start

docker update --restart unless-stopped

```


## CONTAINER LEMP

* https://github.com/adhocore/docker-phpfpm#extensions
* 