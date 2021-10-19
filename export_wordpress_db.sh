#!/bin/bash
mariadb-dump -u root wordpressdb > /import-export/${1}

# Exports the wordpress database to the /import-export folder.
# Use like $ ./export_wordpress_db.sh snapshot_database.sql
