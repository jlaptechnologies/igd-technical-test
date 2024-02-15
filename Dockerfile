FROM php:8.3.2-fpm-alpine3.19 as app

# Run as www-data with same user id
RUN deluser --remove-home www-data \
    && adduser -u1000 -D www-data

LABEL authors="justin.patchett@jlaptech.co.uk"

# Add supervisor to the image for queue processing
RUN apk add tini

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# install gnu-libiconv and set LD_PRELOAD env to make iconv work fully on Alpine image.
# see https://github.com/docker-library/php/issues/240#issuecomment-763112749
ENV LD_PRELOAD /usr/lib/preloadable_libiconv.so

RUN set -eux; \
    apk add --no-cache --virtual .build-deps \
      $PHPIZE_DEPS \
      icu-dev=~74 \
      libzip-dev=~1.10 \
      zlib-dev=~1.3.1 && \
    apk add --no-cache \
      icu-libs=~74 \
      libzip=~1.10 && \
    docker-php-ext-configure zip && \
    docker-php-ext-install -j$(nproc) \
       intl \
       bcmath \
       pcntl \
       pdo_mysql \
       zip && \
    docker-php-ext-enable \
      bcmath.so \
      intl.so \
      opcache.so \
      pcntl.so \
      pdo_mysql.so \
      sodium.so \
      zip.so && \
    apk del .build-deps

# Set the correct permissions for php before we create the volume as they won't take affect afterwards.
RUN mkdir -p /run/php /srv/app && \
    chown -R www-data:www-data /run/php /srv/app

WORKDIR /srv/app

USER www-data

EXPOSE 8090

ENTRYPOINT ["/sbin/tini", "--"]

CMD ["php","/srv/app/src/artisan","serve","--port=8090","--host=0.0.0.0"]
