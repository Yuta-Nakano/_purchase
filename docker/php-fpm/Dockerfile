FROM php:7.4-fpm-buster
SHELL ["/bin/bash", "-oeux", "pipefail", "-c"]

ARG WORK_DIR
# environment
ENV TZ=UTC \
    # locale
    LANG=en_US.UTF-8 \
    LANGUAGE=en_US:en \
    LC_ALL=en_US.UTF-8 \
    # composer
    COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/composer

# composer: install
COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

RUN \
    # apt: update && install
    apt-get update -yqq && \
    apt-get install -yqq \
      git \
      libicu-dev \
      libonig-dev \
      libzip-dev \
      libpq-dev \
      unzip \
      locales \
      postgresql-client \
      libfreetype6-dev \
      libjpeg62-turbo-dev \
      libpng-dev \
    # apt: clean
    && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* \
    # locale
    && \
    locale-gen en_US.UTF-8 && \
    localedef -f UTF-8 -i en_US en_US.UTF-8 \
    # mkdir
    && \
    mkdir /var/run/php-fpm \
    # docker-php-ext
    && \
    docker-php-ext-install \
      intl \
      pdo_mysql \
      pgsql \
      pdo_pgsql \
      zip \
      bcmath \
    && \
    docker-php-ext-configure \
      gd --with-freetype --with-jpeg \
    && \
    docker-php-ext-install \
      gd \
    # composer: config
    && \
    composer config -g process-timeout 3600 && \
    composer config -g repos.packagist composer https://packagist.org

COPY ./php-fpm.d/zzz-www.conf /usr/local/etc/php-fpm.d/zzz-www.conf
COPY ./php.ini /usr/local/etc/php/php.ini

# Configure non-root user.
ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}

RUN groupmod -o -g ${PGID} www-data && \
    usermod -o -u ${PUID} -g www-data www-data

WORKDIR /var/www/${WORK_DIR}