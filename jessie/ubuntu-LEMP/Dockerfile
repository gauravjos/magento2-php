FROM ubuntu:16.04
#ENV PHP_VERSION "7.0.2-1~dotdeb+8.2"
#ENV NGINX_VERSION "1.10.2-1~jessie"
#ENV NJS_VERSION "1.10.2.0.0.20160414.1c50334fbea6-2~jessie"
RUN requirements="mysql-client ca-certificates curl cron openssl git libpng12-dev libmcrypt-dev libmcrypt4 libcurl3-dev libfreetype6 libjpeg-turbo8 libjpeg-turbo8-dev libpng12-dev libfreetype6-dev libicu-dev libxslt1-dev" \
    && apt-get update && apt-get install -y --no-install-recommends --no-install-suggests $requirements \
   # && echo 'deb http://packages.dotdeb.org jessie all' >> /etc/apt/sources.list  \
   # && echo 'deb-src http://packages.dotdeb.org jessie all' >> /etc/apt/sources.list \
   # && curl -Ss https://www.dotdeb.org/dotdeb.gpg | apt-key add - \
   # && echo 'deb http://nginx.org/packages/debian/ jessie nginx' >> /etc/apt/sources.list  \
   # && echo 'deb-src http://nginx.org/packages/debian/ jessie nginx' >> /etc/apt/sources.list \
   # && curl -Ss http://nginx.org/keys/nginx_signing.key | apt-key add - \
   # && apt-get update \ 
    && apt-get install --no-install-recommends --no-install-suggests -y \
    			php7.0 \
    			php7.0-bcmath \
    			php7.0-cli \
    			php7.0-cgi \
    			php7.0-common \
    			php7.0-curl \
    			php7.0-fpm \
    			php7.0-gd \
    			php7.0-intl \  
    			php7.0-json \
    			php7.0-mysql \
    			php7.0-opcache \ 
    			php7.0-soap \
    			php7.0-xml \
    			php7.0-xsl \
    			php7.0-zip \
			php7.0-mcrypt \
			php7.0-mbstring \

    && apt-get install  --no-install-recommends --no-install-suggests -y nginx \
    && rm -rf /var/lib/apt/lists/*
#RUN ln -sf /dev/stdout /var/log/nginx/access.log \
	#&& ln -sf /dev/stderr /var/log/nginx/error.log
RUN sed -i 's/;listen.mode = 0660/listen.mode = 0660/g' /etc/php/7.0/fpm/pool.d/www.conf && sed -i 's/memory_limit = 128M/memory_limit = 2048M/g' /etc/php/7.0/fpm/php.ini 
COPY magento  /etc/nginx/sites-available/default
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
EXPOSE 80
ADD magento2 /var/www/html/magento2
RUN cd /var/www/html/magento2 && chown -R www-data:www-data . && find . -type d -exec chmod 770 {} \; && find . -type f -exec chmod 660 {} \; && chmod u+x bin/magento
#RUN cd /var/www/html/magento2 && chown -R www-data:www-data . && chmod -R 777 . && chmod u+x bin/magento
WORKDIR /var/www/html/magento2
COPY run.sh /usr/local/bin/run
RUN chmod +x /usr/local/bin/run
CMD ["/usr/local/bin/run"]
