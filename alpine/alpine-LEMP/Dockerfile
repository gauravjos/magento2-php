FROM alpine:3.5
RUN apk --update --no-cache add bash nginx libcurl curl openssl \
         libjpeg-turbo libjpeg-turbo-utils libjpeg-turbo-dev \
         icu-libs icu icu-dev \
         libmcrypt libmcrypt-dev \
         freetype freetype-dev \
         libpng libpng-dev \
         mysql-client \
         php7 \
         php7-fpm  \
         php7-gd \
         php7-bcmath \
         php7-dom \
         php7-curl  \
         php7-mcrypt \ 
         php7-xml php7-xmlreader\
         php7-intl \
         php7-mbstring \
         php7-zip \
         php7-xsl \
	 php7-json \
	 php7-openssl \
	 php7-ctype \
	 php7-iconv \
         php7-pdo_mysql 
RUN mkdir -p /run/nginx /var/www/html && ln -s /usr/bin/php7 /usr/bin/php
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN adduser -S -D magento -G root
EXPOSE 80 443
WORKDIR /var/www/html
CMD ["nginx", "-g", "daemon off;"]
