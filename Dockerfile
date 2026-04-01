FROM php:8.2-cli

WORKDIR /app

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip sqlite3 libsqlite3-dev \
    && docker-php-ext-install zip pdo pdo_sqlite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install --no-dev --optimize-autoloader

# create env
RUN cp .env.example .env

# generate key
RUN php artisan key:generate

# create sqlite db
RUN mkdir -p database && touch database/database.sqlite

# run migrations
RUN php artisan migrate

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000