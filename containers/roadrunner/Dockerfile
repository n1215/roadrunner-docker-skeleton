FROM php:7.3-cli

RUN apt-get update && apt-get install -y --no-install-recommends \
  vim \
  libzip-dev \
  unzip \
  procps \
  inotify-tools

# Install PHP Extensions
RUN docker-php-ext-install zip \
  && docker-php-ext-install opcache \
  && docker-php-ext-enable opcache

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
  && php -r "if (hash_file('SHA384', 'composer-setup.php') === rtrim(file_get_contents('https://composer.github.io/installer.sig'))) { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
  && php composer-setup.php \
  && php -r "unlink('composer-setup.php');" \
  && mv composer.phar /usr/local/bin/composer

# Download RoadRunner
ENV RR_VERSION 1.4.4
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
