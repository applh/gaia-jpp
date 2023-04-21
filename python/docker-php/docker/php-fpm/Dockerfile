FROM php:8.2.5-fpm

RUN apt-get update --fix-missing

RUN apt-get install -y curl

RUN apt-get install -y build-essential libssl-dev zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev

RUN docker-php-ext-configure gd && docker-php-ext-install gd