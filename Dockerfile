# Command line arguments, such as PHP version
ARG PHP_VERSION=8.3

#
# --- Stage 1: Build ---
#

FROM lorisleiva/laravel-docker:${PHP_VERSION} as build

ARG BUILD_COMMIT
ARG BUILD_NUMBER
ARG BUILD_TIMESTAMP

# Install dependencies
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --prefer-dist --no-ansi --no-interaction --no-progress --no-scripts

# Copy files 
COPY . .

# Optimize a bit
RUN composer dump-autoload --optimize --classmap-authoritative \
  && php artisan event:cache \
  && php artisan route:cache \
  && php artisan view:cache

#
# --- Stage 2: Run ---
#

FROM ghcr.io/wisemen-digital/php-base:${PHP_VERSION} as final

ARG BUILD_COMMIT
ARG BUILD_NUMBER
ARG BUILD_TIMESTAMP

ENV BUILD_COMMIT $BUILD_COMMIT
ENV BUILD_NUMBER $BUILD_NUMBER
ENV BUILD_TIMESTAMP $BUILD_TIMESTAMP

# Add application
COPY --from=build --chown=nobody /app/ /app/www/

# Symlinks (must be created on final system)
RUN php artisan storage:link
