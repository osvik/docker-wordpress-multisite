#!/bin/bash
cp -R /backups/wp-content/* /var/www/html/wp-content/
chown -R  www-data /var/www/html/wp-content

# When you bind /var/www/html/wp-content to an empty host wp-content folder you may want to run this command and copy a working wp-content.
