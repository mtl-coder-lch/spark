FROM debian:jessie

# Set timezone
RUN cp /usr/share/zoneinfo/Canada/Eastern /etc/localtime

# Install app components
RUN apt-get update -y --fix-missing
RUN apt-get install -y software-properties-common python-software-properties
RUN apt-get install -y apt-transport-https lsb-release ca-certificates wget
RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN echo "deb https://packages.sury.org/php/ jessie main" > /etc/apt/sources.list.d/php.list
RUN apt-get update
RUN apt-get install -y git curl nginx php7.3-cli php7.3-cgi php7.3-fpm php7.3-mysql php7.3-curl php7.3-mbstring zip unzip php7.3-zip php7.3-xml npm nano wget zsh fonts-powerline python-setuptools cron htop
RUN easy_install supervisor

# Install composer php package manager
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

# Change directory structure
RUN rm -rf /var/www/*
ADD . /home/www/spark

# Replace php.ini with a new one that has opcache set
ADD php.ini /etc/php/7.3/cli/php.ini

# Add hosts to sites-available and create symlinks to sites-enabled
ADD hosts/default /etc/nginx/sites-available
ADD hosts/ /etc/nginx/sites-available
RUN chown -R www-data:www-data /etc/nginx
# Enable opcache
RUN phpenmod opcache

# Both services must be executed at the same time or php-fm won't boot automatically after container creation
CMD service php7.3-fpm start && nginx -g "daemon off;"
