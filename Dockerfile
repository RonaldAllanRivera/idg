FROM wordpress:6.4.3-php8.2-apache

RUN a2enmod rewrite

COPY docker/apache-idg.conf /etc/apache2/conf-enabled/idg.conf

COPY docker/php/zz-idg-local.ini /usr/local/etc/php/conf.d/zz-idg-local.ini
