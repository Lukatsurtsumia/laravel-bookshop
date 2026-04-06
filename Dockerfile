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

RUN docker-php-ext-install pdo pdo_mysql pdo_sqlite 

COPY . . 

# install composer 
RUN curl -sS https://getcomposer.org/installer | php 
RUN php composer.phar install --no-dev --optimize-autoloader 

# create sqlite database 
RUN mkdir -p database 
RUN touch database/database.sqlite 

RUN chmod -R 777 storage bootstrap/cache database 

EXPOSE 10000 CMD sh -c "php artisan config:clear && php artisan cache:clear && php artisan migrate:fresh --seed --force && php artisan serve --host=0.0.0.0 --port=10000" 
