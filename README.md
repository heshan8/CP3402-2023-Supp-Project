# Development and Deployment Workflow

## Tools Used
* Project management - `Trello`
* CMS - `WordPress`
* Local Development - `Docker and PHP Storm`
* Version Control - `GitHub`


## Trello

Trello is an online list making tool/board used for organizing and tracking projects.

Sign up to trello using your email then use the link below to join the existing board created. Use the completed tasks  
on the board as a starting point for future development.

Link to existing board: https://trello.com/invite/b/czjXrQcS/ATTI92780f7d9ecde26318b477099f60fa8f522944A5/cp3402-workflow

## Local Development - Docker and PHP Storm  

Docker is a virtualization software platform that allows you to build, test, and deploy applications.  
A Docker container was used to deploy WordPress locally.

PHP Storm was used to work on the theme, given its popularity, unfriendly ui, syntax highlighting and easy integration.

#### Step 1: Setup local deployment using docker container
* Download and install docker desktop frm here: https://www.docker.com/products/docker-desktop/
* Download and install Git from here: https://gitforwindows.org/
* To check if docker is installed correctly, open git bash and run `docker ps`
* If it worked it should look like this:
  * `$ docker ps`    
    `CONTAINER ID   IMAGE              COMMAND                  CREATED        STATUS`
* Run `mkdir wordpress-local && cd wordpress-local` and  `touch docker-compose.yml` one after the other
* this will create a directory called wordpress-local on your computer, then add a new file called docker-compose.yml inside that directory
* Find the newly created folder and open the "docker-compose.yml" file
* Copy the code from below in to the file and save it
* Run `docker-compose up -d` on git bash and wait for the set-up to complete
* Once the setup has been completed got to http://localhost:8000/ on your browser to start WordPress

#### Docker Compose File
```version: "3"
services:
    mysql_db:
        container_name: mysql_container
        image: mysql:5.7
        restart: always
        environment:
            MYSQL_ROOT_PASSWORD: mysql_password12345
            MYSQL_DATABASE: wordpress_db
            MYSQL_USER: wordpress_user
            MYSQL_PASSWORD: wordpress_password12345
        volumes:
            - mysql:/var/lib/mysql
    wordpress:
        depends_on:
            - mysql_db
        image: wordpress:latest
        restart: always
        volumes:
            - ./wordpress_data:/var/www/html
            - ./themes:/var/www/html/wp-content/themes
            - ./upload.ini:/usr/local/etc/php/conf.d/uploads.ini
        ports:
            - "8000:80"
        environment:
            WORDPRESS_DB_HOST: mysql_container
            WORDPRESS_DB_USER: wordpress_user
            WORDPRESS_DB_PASSWORD: wordpress_password12345
            WORDPRESS_DB_NAME: wordpress_db
            
volumes:
  mysql:  
```

## Version Control - Git Hub




