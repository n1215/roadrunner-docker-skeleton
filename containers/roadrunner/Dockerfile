FROM php:8.0-cli

RUN apt-get update && apt-get install -y --no-install-recommends \
  vim \
  libzip-dev \
  unzip

# Install PHP Extensions
RUN docker-php-ext-install zip \
  && docker-php-ext-install opcache \
  && docker-php-ext-enable opcache

# Install Composer
COPY --from=composer /usr/bin/composer /usr/local/bin/composer

# Download RoadRunner
ENV RR_VERSION 1.9.2
RUN mkdir /tmp/rr \
  && cd /tmp/rr \
  && echo "{\"require\":{\"spiral/roadrunner\":\"${RR_VERSION}\"}}" >> composer.json \
  && composer install \
  && vendor/bin/rr get-binary -l /usr/local/bin \
  && rm -rf /tmp/rr

# Copy RoadRunner config
COPY config /etc/roadrunner

WORKDIR /var/www

ENTRYPOINT ["/usr/local/bin/rr", "serve", "-d", "-c", "/etc/roadrunner/.rr.yaml"]
