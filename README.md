# ToDo

ToDo is a simple task / todo list written in PHP with a MySQL back end.

# Requirements

Tested on Debain 11 (Bullseye)

apt install mariadb-server php libapache2-mod-php php-zip php-mbstring php-cli php-common php-curl php-xml php-mysql

# Features

* Add / Delete tasks
* Assign a person to each task
* Mark a task as done
* Mobile Friendly

# Upcoming Features

* Docker Container

# Installation

cd to /var/www/html

git clone this project

Create a database and import the .sql file for the structure

edit conn.php to point to your Mysql Server details and database name

# Docker Installation (a bit hacky but it works)

This will create 3 containers... the webserver, mysql and phpmyadmin.. if you already have mysql and don't need phpymyadmin then cut them out of the docker-compose.yml

```bash
git clone https://github.com/danmed/Docker-LAMP-stack.git todo
docker build todo
cd todo
docker-compose up -d
cd /root/data/todo/html
git clone https://github.com/danmed/todo.git .
nano conn.db
```
edit the connection details to point to your mysql database (having imported the sql.sd file already)

Note : if anyone can help me do this properly it would be really appreciated!

# Screenshots

![image](https://user-images.githubusercontent.com/3878490/219698710-632d0e16-1519-469e-b6c5-fc2e6dd2fa15.png)

![image](https://user-images.githubusercontent.com/3878490/219698831-2fab903f-4403-422e-bbc5-479e6d31363e.png)


