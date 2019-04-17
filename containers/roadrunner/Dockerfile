FROM golang:1.11 as builder

ENV GO111MODULE on
ENV RR_VERSION v1.3.0

RUN apt-get update \
    && apt-get install -y --no-install-recommends git

# Build RoadRunner
WORKDIR /go/src
RUN git clone --depth 1 --branch ${RR_VERSION} https://github.com/spiral/roadrunner \
  && cd /go/src/roadrunner \
  && make \
  && make install

# PHP Image
FROM php:7.2-cli

RUN apt-get update \
  && apt-get install -y --no-install-recommends vim zlib1g-dev unzip

# Copy RoadRunner binary and config
COPY --from=builder /go/src/roadrunner/rr /usr/local/bin/rr
#COPY config /etc/roadrunner # is empty

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

WORKDIR /var/www

ENTRYPOINT ["/usr/local/bin/rr", "serve", "-d", "-c", "/etc/roadrunner/.rr.yaml"]
