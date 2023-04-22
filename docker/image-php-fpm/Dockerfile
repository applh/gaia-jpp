FROM php:8.2.5-fpm

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

RUN apt-get clean && apt-get autoclean
