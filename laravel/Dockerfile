# ベースイメージとして PHP 8.1 FPM を使用
FROM php:8.1-fpm

# システム依存パッケージのインストール
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libzip-dev \
    && docker-php-ext-install pdo_mysql zip

# Composer のインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 作業ディレクトリの設定
WORKDIR /var/www
