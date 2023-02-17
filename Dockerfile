# Dockerfile
FROM php:7.4-apache
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY *.php /var/www/html
RUN apt-get update && \
    apt install mariadb-server php libapache2-mod-php php-zip php-mbstring php-cli php-common php-curl php-xml php-mysql
CMD ["start-apache"]
