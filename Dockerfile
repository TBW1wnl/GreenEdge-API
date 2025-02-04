FROM php:8.2-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev zip

COPY . /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

CMD ["php-fpm"]
