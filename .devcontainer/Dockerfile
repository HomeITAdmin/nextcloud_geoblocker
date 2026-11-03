ARG PHP_VERSION=8.3
FROM php:${PHP_VERSION}-cli-bookworm

ARG NEXTCLOUD_BRANCH=stable35

RUN apt-get update && apt-get install -y --no-install-recommends \
      git unzip sudo geoip-bin geoip-database \
    && rm -rf /var/lib/apt/lists/*

# PHP-Erweiterungen, die Nextcloud zusätzlich zu den eingebauten braucht
ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN install-php-extensions gd intl zip bz2 pcntl pdo_mysql gmp bcmath apcu pcov \
 && echo "memory_limit=512M" > /usr/local/etc/php/conf.d/nextcloud.ini

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

RUN useradd -m -u 1000 -s /bin/bash dev \
 && echo 'dev ALL=(ALL) NOPASSWD:ALL' > /etc/sudoers.d/dev \
 && mkdir -p /srv/nextcloud /var/lib/GeoIP && chown dev:dev /srv/nextcloud /var/lib/GeoIP

USER dev
RUN git clone --depth 1 --branch ${NEXTCLOUD_BRANCH} \
      --recurse-submodules --shallow-submodules \
      https://github.com/nextcloud/server.git /srv/nextcloud

WORKDIR /srv/nextcloud