#!/bin/bash
rpl https://${1} 'https://localhost' /import-export/${2}
rpl ${1} 'localhost' /import-export/${2}

# Replaces references to your production domain to localhost in the database.
# Use like: $ ./import_wordpress_db.sh yourdomain.org yoursite_wordpress_db.sql
