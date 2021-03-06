FROM php:8.0-fpm

WORKDIR /usr/local/www/data/analysis/

ADD ./php.ini /usr/local/etc/php/conf.d/php.ini

RUN apt-get -qq update \
    && usermod -u 1000 www-data \
    && apt-get -qq install --yes --no-install-recommends sudo curl openssh-client rsync \
    && apt-get -qq install -y --no-install-recommends \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libwebp-dev \
        libldap-dev \
        libzip-dev \
        gnupg \
        nano \
        bash sshpass \
    && docker-php-ext-configure gd \
        --with-freetype=/usr/include/ \
        --with-jpeg=/usr/include/ \
        --with-webp=/usr/include \
    && NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) \
    && docker-php-ext-install -j${NPROC} gd \
    && docker-php-ext-install -j${NPROC} zip \
    && docker-php-ext-install -j${NPROC} ldap \
    && docker-php-ext-install -j${NPROC} pdo_mysql \
    && pecl install xdebug-3.1.0 \
    && docker-php-ext-enable xdebug \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.0.14 \
