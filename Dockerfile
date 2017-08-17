FROM registry.service.opg.digital/opguk/php-fpm

RUN php5enmod mcrypt

# enable php5-xdebug for code coverage
RUN cp /etc/php5/xdebug-enable.ini /etc/php5/fpm/conf.d/20-xdebug.ini
RUN cp /etc/php5/xdebug-enable.ini /etc/php5/cli/conf.d/20-xdebug.ini

RUN apt-get update && apt-get install -y \
    php5-curl php-pear php5-dev

RUN apt-get install -y pkg-config

RUN pecl install mongodb-1.2.9 && \
    echo "extension=mongodb.so" > /etc/php5/mods-available/mongodb.ini && \
    php5enmod mongodb

RUN  cd /tmp && curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer
COPY composer.json /app/
COPY composer.lock /app/
WORKDIR /app
USER app
ENV  HOME /app
RUN  composer install