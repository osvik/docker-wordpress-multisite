- [Develop Wordpress multisite in docker](#develop-wordpress-multisite-in-docker)
  - [Start Docker](#start-docker)
  - [Build the Docker image](#build-the-docker-image)
  - [Create the docker container](#create-the-docker-container)
  - [Run the container](#run-the-container)
  - [In the container /app folder](#in-the-container-app-folder)
  - [Login in Wordpress](#login-in-wordpress)
  - [Login in PhpMyAdmin](#login-in-phpmyadmin)
  - [Copy your website database to the development environment](#copy-your-website-database-to-the-development-environment)
  - [Database snapshots](#database-snapshots)
  - [Develop with git, vscode and other programs](#develop-with-git-vscode-and-other-programs)
  - [Error logs](#error-logs)

# Develop Wordpress multisite in docker

This repository creates a **development environment** in Docker to develop a website in Wordpress multisite. **Do not use in production or public URLs, use in https://localhost only.**

It uses Debian 11 “bullseye” as the basis, which is a common server distro. Read the [Dockerfile](Dockerfile) for more information.

For simplicity it uses a single container for the PHP server and MySQL. This will also allow you to run different containers and different databases for different git feature branches if you want. Or revert to a previously exported database state.

## Start Docker

Start docker (in a Mac use the command bellow):

```
open -a Docker
```

## Build the Docker image

Normally you'll need to do this just once:

```
cd /path/to/this/repository
docker build -t wordpressmultisite .
```

It will take a while to download the files if it's not cached.

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

**Alternatively** you can separate the uploads folder in the host with this container setting:

```
docker run -t -d \
  -v $HOME/websites/mysite2/wp-content:/var/www/html/wp-content \
  -v $HOME/websites/mysite2/uploads:/var/www/html/wp-content/uploads \
  -v $HOME/websites/mysite2/import-export:/import-export \
  -p 443:443 \
  --name mysite wordpressmultisite
```

This might be useful to make it easier to rsync to update the images.

## Run the container

List running containers, start, stop and remove containers: 

```
docker ps
docker start mysite
docker stop mysite
docker rm mysite
```

To login the container:

```
docker exec -ti mysite bash
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

Please note it uses a self-signed https certificate, so you'll need to accept the browser's exception the first time. In **Firefox** and **Safari** this is very straightforward. Just follow the interactive instructions on screen.

In **Chome**-based browsers you must go to [localhost](https://localhost), inspect with the developer tools, open the console and paste the following command:

```
sendCommand(SecurityInterstitialCommandId.CMD_PROCEED)
```

## Login in Wordpress

- [Wordpress admin](https://localhost/wp-admin/)
- Username: `admin`
- Password: `va34raDFR64gbjkU`

## Login in PhpMyAdmin

- [PhpMyAdmin](https://localhost/phpmyadmin/)
- Username: `generic`
- Password: `gfvcry35y@ehG1209`

## Copy your website database to the development environment

First download a dump of your production site database into your `$HOME/websites/mysite/import-export` folder (in your computer).

Then, in your container shell, replace references bellow to your real domain/subdomain and database sql file.

Update the container database with the database from the site:

```
./import_wordpress_db.sh yourdomain.org yoursite_wordpress_db.sql
```

This will update yourdomain.org references in the database to `localhost`. If your site URL includes the www, then you should add it to the command above.

## Database snapshots

Snapshots allow you to save the database state at any moment. And revert to that state latter.

To export a snapshot of the database at any moment:

```
./export_wordpress_db.sh snapshot_database.sql
```

The file `snapshot_database.sql` will be saved in the host machine in the `$HOME/websites/mysite/import-export` folder.

To import this snapshot latter:

```
./import_wordpress_db.sh localhost snapshot_database.sql
```


## Develop with git, vscode and other programs

Now you can develop themes or plugins using your own computer tools inside the `wp-content` folder.

```
cd ~/websites/mysite/wp-content
```

## Error logs

- It will be created a Wordpress `debug.log` file inside `wp-content` 
- The access and error logs can be obtained in the container shell with `tail`, `cat` or `more`, like for example:

```
tail -f /var/log/nginx/access.log
tail -f /var/log/nginx/error.log
```
