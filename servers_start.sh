#!/bin/bash
service nginx start && service php7.4-fpm start && service mariadb start

# Starts the servers so you can run Wordpress Multisite in https://localhost/
