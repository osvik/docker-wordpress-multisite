FROM debian
LABEL maintainer "Osvaldo Gago <osvaldo@duck.com>"
RUN \
  apt update && apt upgrade -y
RUN \
  apt update && apt install -y \
  nginx \
  ssl-cert \
  mariadb-server \
  mariadb-client
RUN \
  apt update && apt install -y \
  php-fpm \
  php-mysql \
  php-mbstring \
  php-curl \
  php-sqlite3 \
  php-imagick \
  php-zip \
  php-dom \
  php-intl \
  php7.4-gd
RUN \
  apt update && apt install -y \
  curl \
  wget \
  unzip \
  rpl
EXPOSE 80 443
WORKDIR /var/www/html
RUN \
  wget https://files.phpmyadmin.net/phpMyAdmin/5.1.1/phpMyAdmin-5.1.1-all-languages.zip && \
  unzip phpMyAdmin-5.1.1-all-languages.zip && \
  mv phpMyAdmin-5.1.1-all-languages phpmyadmin && \
  rm phpMyAdmin-5.1.1-all-languages.zip && \
  chown -R  www-data phpmyadmin
WORKDIR /etc/nginx/sites-available
COPY nginx/wordpress_multisite.conf .
RUN \
  rm /etc/nginx/sites-enabled/default && \
  ln -s /etc/nginx/sites-available/wordpress_multisite.conf /etc/nginx/sites-enabled/
WORKDIR /app
COPY sql/create_sql_user.sql .
RUN \
  service mariadb start && \
  mariadb -u root < create_sql_user.sql
COPY *.sh .
RUN \
  chmod u+x *.sh
WORKDIR /var/www/html
RUN \
  wget https://wordpress.org/latest.zip && \
  unzip latest.zip && \
  rm latest.zip && \
  cp -R wordpress/* ./ && \
  rm -rf wordpress
COPY php/wp-config.php .
RUN \
  chown -R  www-data /var/www/html
WORKDIR /app
COPY sql/wordpressdb.sql .
RUN \
 service mariadb start && \
 mariadb -u root wordpressdb < wordpressdb.sql && \
 rm wordpressdb.sql create_sql_user.sql
RUN \
 rm /var/www/html/wp-content/plugins/hello.php && \
 rm -r /var/www/html/wp-content/plugins/akismet && \
 rm -r /var/www/html/wp-content/themes/twentynineteen && \
 rm -r /var/www/html/wp-content/themes/twentytwenty && \
 mkdir /backups && \
 cp -R /var/www/html/wp-content /backups


