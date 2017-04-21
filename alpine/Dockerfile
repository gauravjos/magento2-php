FROM apache2-php5.6-composer
RUN mkdir -p /var/www/html && adduser -S -D -H magento -G www-data && apk add --no-cache mysql-client \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd \
    && docker-php-ext-install mcrypt \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install zip \
    && docker-php-ext-install intl \
    && docker-php-ext-install xsl \
    && docker-php-ext-install soap \
WORKDIR /var/www/html
ADD magento2 /var/www/html/magento2
RUN cd /var/www/html/magento2 && find var vendor pub/static pub/media app/etc -type f -exec chmod g+w {} \; && find var vendor pub/static pub/media app/etc -type d -exec chmod g+ws {} \; && chown -R magento:www-data /var/www/html/magento2
