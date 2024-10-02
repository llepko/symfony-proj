FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    libmariadb-dev \
    libmagickwand-dev --no-install-recommends \
    build-essential \
    libfreetype6-dev \
    locales \
    zlib1g-dev libicu-dev g++ \
    zip \
    libzip-dev \
    libxml2-dev \
    libssl-dev \
    libxslt1-dev \
    unzip \
    git \
    curl \
    wget

RUN docker-php-ext-install pdo pdo_mysql

# Clear cache
RUN docker-php-source delete \
 && apt-get autoremove --purge -y \
 && apt-get autoclean -y \
 && apt-get clean -y \
 && rm -rf /var/lib/apt/lists/*

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install symfony cli
RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

# Set working directory
WORKDIR /var/www
