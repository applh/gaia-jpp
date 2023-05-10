FROM php:fpm

RUN apt-get update --fix-missing

RUN apt-get install -y curl

RUN apt-get install -y build-essential libssl-dev zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev

RUN docker-php-ext-configure gd && docker-php-ext-install gd

RUN docker-php-ext-configure pdo_mysql && docker-php-ext-install pdo_mysql

RUN docker-php-ext-configure mysqli && docker-php-ext-install mysqli

RUN apt-get install -y imagemagick libmagickwand-dev

RUN pecl install imagick

RUN docker-php-ext-enable imagick

RUN apt-get install -y ffmpeg

RUN docker-php-ext-configure exif && docker-php-ext-install exif

RUN apt-get install -y libzip-dev

RUN docker-php-ext-configure zip && docker-php-ext-install zip

RUN docker-php-ext-configure bcmath && docker-php-ext-install bcmath

RUN apt-get install -y libssh2-1-dev libssh2-1

RUN pecl install ssh2

RUN docker-php-ext-enable ssh2

RUN docker-php-ext-configure sockets && docker-php-ext-install sockets

RUN apt-get install -y ghostscript

RUN apt-get install -y memcached libmemcached-dev

RUN pecl install memcached

RUN docker-php-ext-enable memcached

# install jupyter notebook
RUN apt-get install -y python3-pip
RUN pip3 install jupyter Pillow requests numpy opencv-python matplotlib ipython db-sqlite3 playwright

# playwright and ipython setup
RUN playwright install
RUN playwright install-deps
# RUN playwright install chromium

# ipython will need $HOME env variable
# and playwright must be installed in $HOME/.cache
# move /root/.cache to /var/www/home/.cache
# change owner (recursive)
RUN mkdir /var/www/home \
        && mv /root/.cache /var/www/home/.cache \
        && chown -R www-data:www-data /var/www/home

RUN apt-get clean && apt-get autoclean
