# Develop in Wordpress multisite

This repository creates a **development environment** in Docker to develop a website in Wordpress multisite. **Do not use in production.**

It uses Debian 11 “bullseye” as the basis, which is a common server distro. Read the [Dockerfile](Dockerfile) for more information.

## Build the Docker image

```
cd /path/to/this/repository
docker build -t wordpressmultisite .
```

## Create the docker container

Create the docker container with the binds:

Don't forget to edit your own bind `/Users/osvaldogago/websites/mysite/wp-content` in the command bellow:

```
docker run -t -d -v "/Users/osvaldogago/websites/mysite/wp-content:/var/www/html/wp-content" -p 443:443 --name mysite wordpressmultisite
```

## Run the container

To list running containers:

```
docker ps
```

To start a stopped container:

```
docker start mysite
```

To stop a container:

```
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

## Conclusion

Now you can develop with your own computer tools inside the wp-content tool.

```
cd ~/websites/mysite/wp-content
```
