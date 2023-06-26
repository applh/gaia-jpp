# CONTAINER PHP

## docker-compose

* WARNING: The image is about 5Go
  * PHP
    * extensions required for WP, laravel, symfony, ... 
  * Python
    * jupyter
    * playwright
    * opencv
    * ...
 
### build

```sh
docker-compose build
```

### up

```sh
docker-compose up -d
```

## MacOS: SSL for local https

### create a key and certificate

* create a folder my-ssl
* open terminal in my-ssl folder
* Generate a new key and certificate in my-ssl
    * change your infos in the `-subj` option
    * C=Country
    * ST=State
    * L=Location
    * O=Organization
    * OU=Organization Unit
    * CN=Common Name
        * IMPORTANT: CN must be the same as the domain name you will use in your browser
  
```sh
openssl req \
-newkey rsa:2048 -nodes -keyout "dev.gaia.key" \
-x509 -days 365 -out "dev.gaia.crt" \
-subj "/C=FR/ST=Med/L=Mars/O=Applh.com/OU=AI/CN=dev.gaia.test"

# nginx.conf will look for localhost.key and localhost.crt files
cp dev.gaia.key localhost.key
cp dev.gaia.crt localhost.crt

```

Nginx config will setup localhost.key and localhost.crt files for https 
* on port 443

Restart docker container
    * (change terminal directory to docker folder)

```sh
docker-compose down
docker-compose up -d
```

### MacOS: add certificate to MacOS keychain

* double click on localhost.crt
* update trust to "always trust"

* restart chrome
    * WARNING 
    * https://dev.gaia.test will show a warning the first time
    * but you can click on "advanced" and "continue"

### MacOS: add domain to /etc/hosts

* open file /etc/hosts
* add the line

```txt

127.0.0.1 dev.gaia.test

```

or install `dnsmasq` to avoid to edit `/etc/hosts` file

```sh
brew install dnsmasq
```

* setup
* https://allanphilipbarku.medium.com/setup-automatic-local-domains-with-dnsmasq-on-macos-ventura-b4cd460d8cb3


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



