FROM  php:5.6-apache
RUN requirements="mysql-client cron libpng12-dev libmcrypt-dev libmcrypt4 libcurl3-dev libfreetype6 libjpeg62-turbo libjpeg62-turbo-dev libpng12-dev libfreetype6-dev libicu-dev libxslt1-dev" \
    && apt-get update && apt-get install -y $requirements && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd \
    && docker-php-ext-install mcrypt \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install zip \
    && docker-php-ext-install intl \
    && docker-php-ext-install xsl \
    && docker-php-ext-install soap \
    && requirementsToRemove="libpng12-dev libmcrypt-dev libcurl3-dev libpng12-dev libfreetype6-dev libjpeg62-turbo-dev" \
    && apt-get purge --auto-remove -y $requirementsToRemove
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
COPY apache2.conf /etc/apache2/apache2.conf
RUN /bin/echo "memory_limit = 1024M">/usr/local/etc/php/conf.d/mem.ini
RUN a2enmod rewrite && /etc/init.d/apache2 restart 
RUN useradd magento && usermod -g www-data magento
ADD magento2.1 /var/www/html/magento2.1
RUN cd /var/www/html/magento2.1 && find var vendor pub/static pub/media app/etc -type f -exec chmod g+w {} \; && find var vendor pub/static pub/media app/etc -type d -exec chmod g+ws {} \; && chown -R magento:www-data /var/www/html/magento2.1
COPY run.sh /usr/local/bin/run
RUN chmod +x /usr/local/bin/run
CMD ["/usr/local/bin/run"]
