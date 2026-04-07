FROM php:8.2-cli

WORKDIR /app

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zip \
    curl \
    sqlite3 \
    libsqlite3-dev

RUN docker-php-ext-install pdo pdo_mysql pdo_sqlite mbstring bcmath zip

COPY . .

RUN curl -sS https://getcomposer.org/installer | php

RUN cp .env.example .env

RUN php -d memory_limit=-1 composer.phar install --no-dev --optimize-autoloader

RUN mkdir -p database
RUN touch database/database.sqlite

RUN chmod -R 777 storage bootstrap/cache database

CMD sh -c "php artisan key:generate && php artisan migrate --seed --force && php artisan serve --host=0.0.0.0 --port=10000"
