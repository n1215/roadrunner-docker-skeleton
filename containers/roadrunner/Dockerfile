FROM php:7.2-cli

RUN apt-get update && apt-get install -y --no-install-recommends \
  wget \
  git \
  vim \
  zlib1g-dev \
  unzip

# Install Go
RUN wget -O - https://dl.google.com/go/go1.11.4.linux-amd64.tar.gz | tar -C /usr/local -xzf -
ENV PATH $PATH:/usr/local/go/bin
ENV GO111MODULE on

# Install RoadRunner
WORKDIR /go/src
RUN git clone --depth 1 https://github.com/spiral/roadrunner \
  && cd /go/src/roadrunner \
  && make \
  && make install
COPY ./.rr.yaml /etc/roadrunner/.rr.yaml

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

ENTRYPOINT ["/usr/local/bin/rr", "serve", "-c", "/etc/roadrunner/.rr.yaml"]
