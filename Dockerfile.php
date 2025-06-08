ARG PHP_VERSION
FROM php:${PHP_VERSION}

# Install system dependencies and PHP extensions for WordPress-like apps
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd mysqli pdo pdo_mysql zip

# Clean up
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
