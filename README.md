# Develop in Wordpress multisite

This repository creates a **development environment** in Docker to develop a website in Wordpress multisite. **Do not use in production.**

It uses Debian 11 “bullseye” as the basis, which is a common server distro. Read the [Dockerfile](Dockerfile) for more information.

## Build the Docker image

Normally you'll need to do this just once.

```
cd /path/to/this/repository
docker build -t wordpressmultisite .
```

## Create the docker container

Create the docker container. You don't need to do this often...

Don't forget to edit your own binds (-v) in the command bellow:

```
docker run -t -d \
  -v $HOME/websites/mysite/wp-content:/var/www/html/wp-content \
  -v $HOME/websites/mysite/import-export:/import-export \
  -p 443:443 \
  --name mysite wordpressmultisite
```

The `wp-content` folder is where themes, plugins and all will be developed.

The `import-export` folder will be used to import the MySQL database dump from an existing site to this development container.


## Run the container

List running containers, start and stop containers: 

```
docker ps
docker start mysite
docker stop mysite
```

To login the container:

```
docker exec -ti mysite sh -c "bash"
```

## In the container /app folder

Start nginx, mariadb and php:

```
./servers_start.sh
```

If you are binding  `/var/www/html/wp-content` folder to an empty folder in your host machine you may want to restore the default `wp-content` with:

```
./default_wp-content.sh
```

Now you can visit your website home page:

https://localhost/

## Login in Wordpress

- [Wordpress admin](https://localhost/wp-admin/)
- Username: `admin`
- Password: `va34raDFR64gbjkU`

## Login in PhpMyAdmin

- [PhpMyAdmin](https://localhost/phpmyadmin/)
- Username: `generic`
- Password: `gfvcry35y@ehG1209`

## Use a copy of your website database for development

First download a dump of your production site database into your `$HOME/websites/mysite/import-export` folder.

Then in your container shell:

```
cd /import-export/
```

Replace references bellow to your real domain/subdomain and database sql file.

```
rpl 'https://yourdomain.org' 'https://localhost' yoursite_wordpress_db.sql
rpl 'yourdomain.org' 'localhost' yoursite_wordpress_db.sql
```

Update the container database with the database from the site:

```
mariadb -u root -e "DROP DATABASE wordpressdb;"
mariadb -u root -e "CREATE DATABASE wordpressdb;"
mariadb -u root wordpressdb < yoursite_wordpress_db.sql
```

## Conclusion

Now you can develop with your own computer tools inside the wp-content tool.

```
cd ~/websites/mysite/wp-content
```

## Notes

- In `wp-content` it will be created a `debug.log` file.