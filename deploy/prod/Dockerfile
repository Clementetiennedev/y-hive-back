# Stage 1: Build stage
FROM php:8.3-fpm-alpine AS build

# Installer les dépendances système et extensions PHP nécessaires
RUN apk add --no-cache \
    zip \
    unzip \
    git \
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
    nodejs \
    npm \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip pdo pdo_mysql pdo_pgsql intl exif bcmath gettext opcache \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-enable gd

# Installer Redis
RUN pecl install redis \
    && docker-php-ext-enable redis

# Installer Composer
COPY --from=composer:2.7.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copier le projet
COPY . /var/www/html

# Définir les permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Installer les dépendances PHP et Node.js
RUN composer install --no-dev --prefer-dist \
    && npm ci --legacy-peer-deps \
    && npm run build

# Fixer les permissions après l’installation
RUN chown -R www-data:www-data /var/www/html/vendor \
    && chmod -R 775 /var/www/html/vendor

# Stage 2: Production stage
FROM php:8.3-fpm-alpine

# Installer les extensions et dépendances nécessaires
RUN apk add --no-cache \
    nginx \
    zip \
    unzip \
    git \
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
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip pdo pdo_mysql pdo_pgsql intl exif bcmath gettext opcache \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-enable gd redis

# Copier les fichiers depuis le build stage
COPY --from=build /var/www/html /var/www/html
COPY ./deploy/prod/nginx.conf /etc/nginx/http.d/default.conf
COPY ./deploy/prod/php.ini "$PHP_INI_DIR/conf.d/app.ini"

WORKDIR /var/www/html

# Configuration PHP
RUN echo "short_open_tag=Off" >> /usr/local/etc/php/php.ini \
    && echo "upload_max_filesize=150M" >> /usr/local/etc/php/php.ini \
    && echo "post_max_size=150M" >> /usr/local/etc/php/php.ini \
    && echo "memory_limit=256M" >> /usr/local/etc/php/php.ini

# Exposer les ports pour Nginx et PHP-FPM
EXPOSE 80 443

# Lancer Nginx et PHP-FPM
CMD ["sh", "-c", "nginx && php-fpm"]
