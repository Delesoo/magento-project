FROM markoshust/magento-php:8.3-fpm-2

USER root

RUN docker-php-ext-install calendar

RUN apt-get update && apt-get install -y nano

USER app
