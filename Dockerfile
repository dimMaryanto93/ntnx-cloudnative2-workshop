FROM php:7.4-fpm
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd
RUN apt-get update -y && apt-get install -y libxml2-dev libmcrypt-dev openssl
RUN apt-get install -y unzip wget iputils-ping
RUN apt-get install -qq libpq-dev git curl libzip-dev libmcrypt-dev libjpeg-dev libpng-dev libfreetype6-dev libbz2-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN pecl install mcrypt-1.0.3
RUN docker-php-ext-enable mcrypt
RUN docker-php-ext-install mysqli pdo pdo_pgsql pdo_mysql tokenizer xml pcntl
WORKDIR /app
COPY . /app
RUN composer install

RUN mv env.master .env
RUN php artisan optimize
CMD php artisan serve --host=0.0.0.0 --port=9999
EXPOSE 9999
