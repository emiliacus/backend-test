FROM php:7.4.10-fpm

RUN echo "allow_url_fopen = On" > /usr/local/etc/php/conf.d/test.ini
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin -- --filename=composer
RUN apt-get update && apt-get install git mariadb-client zlib1g-dev libzip-dev unzip -y

WORKDIR /var/www