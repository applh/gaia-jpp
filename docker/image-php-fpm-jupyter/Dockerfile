FROM php:fpm

RUN apt-get update --fix-missing

RUN apt-get install -y curl cron build-essential \
libssl-dev zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev libzip-dev libssh2-1-dev \
ffmpeg libssh2-1 ghostscript \
imagemagick libmagickwand-dev \
memcached libmemcached-dev \
python3-pip

RUN docker-php-ext-configure gd && docker-php-ext-install gd

RUN docker-php-ext-configure pdo_mysql && docker-php-ext-install pdo_mysql

RUN docker-php-ext-configure mysqli && docker-php-ext-install mysqli

RUN pecl install imagick

RUN docker-php-ext-enable imagick

RUN docker-php-ext-configure exif && docker-php-ext-install exif

RUN docker-php-ext-configure zip && docker-php-ext-install zip

RUN docker-php-ext-configure bcmath && docker-php-ext-install bcmath

RUN pecl install ssh2

RUN docker-php-ext-enable ssh2

RUN docker-php-ext-configure sockets && docker-php-ext-install sockets

RUN pecl install memcached

RUN docker-php-ext-enable memcached

# install jupyter notebook
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

# FIXME: INSTALL CRON FOR USER root
# MUST BE ACTIAVTED IN ENTRYPOINT
# service cron start
# COPY crontab-root-gaia /root/crontab-root-gaia
# RUN service cron start
# RUN cat /root/crontab-root-gaia | crontab -
