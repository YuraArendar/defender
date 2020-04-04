FROM php:7.4-fpm
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libonig-dev \
        libpq-dev \
        libxml2-dev \
        libmcrypt-dev \
        zlib1g-dev \
        libzip-dev \
        graphviz \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install zip \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install -j$(nproc) xml tokenizer ctype bcmath

CMD ["php-fpm"]
