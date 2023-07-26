# Development and Deployment Workflow

## Tools Used
* Project management - `Trello`
* CMS - `WordPress`
* Local Development - `Docker and PHP Storm`
* Version Control - `GitHub`
* Production Environment - `Digital Ocean`


## Trello

Trello is an online list making tool/board used for organizing and tracking projects.

Sign up to trello using your email then use the link below to join the existing board created. Use the completed tasks  
on the board as a starting point for future development.

Link to existing board: https://trello.com/invite/b/czjXrQcS/ATTI92780f7d9ecde26318b477099f60fa8f522944A5/cp3402-workflow

## Local Development - Docker

Docker is a virtualization software platform that allows you to build, test, and deploy applications.  
A Docker container was used to deploy WordPress locally.

PHP Storm was used to work on the theme, given its popularity, unfriendly ui, syntax highlighting and easy integration.

### Step 1: Setup local deployment using docker container
* Download and install docker desktop frm here: https://www.docker.com/products/docker-desktop/
* Download and install Git from here: https://gitforwindows.org/
* To check if docker is installed correctly, open git bash and run `docker ps`
* If it worked it should look like this:
  * `$ docker ps`    
    `CONTAINER ID   IMAGE              COMMAND                  CREATED        STATUS`
* Run `mkdir wordpress-local && cd wordpress-local` and  `touch docker-compose.yml` one after the other
* this will create a directory called wordpress-local on your computer, then add a new file called docker-compose.yml inside that directory
* Find the newly "wordpress-local" folder and open the "docker-compose.yml" file
* Copy the "Docker Compose File" code from below in to the file and save it
* Run `docker-compose up -d` on git bash and wait for the set-up to complete

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

### Step 2: Setup local WordPress in browser
* Once step one has been completed got to http://localhost:8000/ on your browser to start WordPress
* Select a language
* Enter a site title, a username, your email.
  * Copy and store the generated password and the username in a safe location
* Click install WordPress
* Proceed to log in or go to `http://localhost:8000/wp-admin/` and enter the previously saved password and username to log in
* WordPress is now set up locally

## Version Control - Git Hub
### Step 3: Set up local environment version control
* Inside the "local-wordpress" folder, docker compose will have created a "themes" folder from step 1
* Run `cd <path-to-themes-folder>`
  * Alternatively go in the folder using explorer, right click and select `Git Bash Here` from the menu
* Run `git clone https://github.com/heshan8/CP3402-2023-Supp-Project.git`
* Run `cd <path-to-the-cloned-theme-folder-inside-themes>`
* Run `git branch -a` to list all branches
* Run `git checkout <brnach-name>` to switch to main branch
* Run `git log` to see the latest changes
* Run `git pull` to get the latest updates from the main branch

## Theme Development - PHP Storm
### Step 4: Developing the theme
* Install PHP Storm _(Install guide can be found here: https://www.jetbrains.com/help/phpstorm/installation-guide.html#3bb01cfa)_
* In PHP Storm File > Open
* Navigate to the "themes" folder created by docker compose in step 1
* Select the cloned theme directory from step 3
* Make changes to the theme _(Changes should be made in the testing branch)_
* Create commits using Git Bash or PHP Storm
  * Git Bash 
    * From inside the cloned theme folder `git commit -m "Your commit mesage"`
    * Once changes are made `git push`
  * PHP Storm
    * Select Commit from Git menu
    * Review changes, enter an appropriate commit massage and click commit
    * Select Push from Git menu and click push
* On GitHub create a pull request to review changes and merge with the main branch.
* Repeat task steps 4-8 from step 4
* Log in to local WordPress to test theme changes _(Step 2)_



