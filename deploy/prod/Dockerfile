# Étape 1 : Construction
FROM php:8.3-fpm-alpine as build

# Installer les dépendances système et PHP
RUN apk add --no-cache \
    zip \
    libzip-dev \
    freetype \
    libjpeg-turbo \
    libpng \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    icu-dev \
    oniguruma-dev \
    gettext-dev \
    nginx \
    bash \
    curl \
    nodejs \
    npm \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip pdo pdo_mysql intl \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-enable gd \
    && docker-php-ext-install bcmath exif gettext opcache \
    && docker-php-ext-enable bcmath exif gettext opcache

# Installer Composer
COPY --from=composer:2.7.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copier le projet et configurer les permissions
COPY ../.. .
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Installer les dépendances PHP et Node.js
RUN composer install --no-dev --prefer-dist \
    && npm ci --legacy-peer-deps \
    && npm run build

RUN chown -R www-data:www-data /var/www/html/vendor \
    && chmod -R 775 /var/www/html/vendor

# Étape 2 : Production
FROM php:8.3-fpm-alpine

# Installer nginx et les dépendances
RUN apk add --no-cache \
    nginx

# Copier le projet construit
COPY --from=build /var/www/html /var/www/html
COPY ./deploy/prod/nginx.conf /etc/nginx/http.d/default.conf
COPY ./deploy/prod/php.ini "$PHP_INI_DIR/conf.d/app.ini"

WORKDIR /var/www/html

# Ajouter le volume pour la persistance
VOLUME ["/var/www/html/storage/app"]

CMD ["sh", "-c", "nginx && php-fpm"]
