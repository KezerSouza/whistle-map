# syntax=docker/dockerfile:1

# Stage 1 — compile the frontend assets with Vite.
FROM node:22-alpine AS assets

WORKDIR /app

COPY package.json package-lock.json vite.config.js ./
RUN npm ci

COPY resources ./resources
RUN npm run build

# Stage 2 — resolve PHP dependencies without the development packages.
FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-scripts \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

# Stage 3 — the runtime image published to the registry.
FROM serversideup/php:8.4-fpm-nginx AS production

USER root
RUN install-php-extensions pdo_pgsql pgsql
USER www-data

WORKDIR /var/www/html

COPY --chown=www-data:www-data . .
COPY --from=vendor --chown=www-data:www-data /app/vendor ./vendor
COPY --from=assets --chown=www-data:www-data /app/public/build ./public/build

RUN composer dump-autoload --no-dev --optimize --no-interaction

ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    PHP_OPCACHE_ENABLE=1
