FROM trafex/alpine-nginx-php7

USER root
RUN apk add --no-cache bash \
    php7-pdo php7-pdo_mysql php7-sqlite3 php7-pdo_sqlite\
    php7-mbstring php7-iconv php7-common php7-json php7-curl\
    php7-intl php7-mcrypt php7-gd php7-zip php7-xml php7-gd\
    php7-pear php7-tokenizer php7-dom php7-simplexml

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Symfony installer
RUN wget https://get.symfony.com/cli/installer -O - | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

# redo some trafex work to make image better for active dev
RUN chown -R root:root /run && \
  chown -R root:root /var/lib/nginx && \
  chown -R root:root /var/tmp/nginx && \
  chown -R root:root /var/log/nginx && \
  chown -R root:root /var/www

# Setup document root
RUN mkdir /app && chown root:root /app

# Configuration files
# php configs
COPY docker/php/config/*.ini /etc/php7/conf.d/
COPY docker/php/config-fpm/*.conf /etc/php7/php-fpm.d/
# nginx config
COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
# supervisor config
COPY docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

WORKDIR /app
