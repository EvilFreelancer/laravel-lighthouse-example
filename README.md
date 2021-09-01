# Laravel + GraphQL (Lighthouse PHP) demo application

This application based on Docker containers, here is the list:

* mariadb - Database server
* phpmyadmin - For management of MySQL
* laravel - Login pages, API and VueJS

## How to install

### 1. Preparation

Clone the repo and change your work directory to root of sources

```shell
git clone https://github.com/EvilFreelancer/laravel-lighthouse-example.git
cd laravel-lighthouse-example
cp docker-compose.dist.yml docker-compose.yml
cd laravel
cp .env.example .env
conposer install
cd ..
```

In file `docker-compose.yml` you probably will need the change a values to ones you
need, for example you don't need to run this project on `80` port, to
fix that just change line like `80:80` to required values, eg. `7777:80`.

Run first iteration of Docker environment:

```shell
docker-compose up -d
```

### 2. Inside container

Need to login into the Laravel container:

```shell
docker-compose exec laravel bash
```

And fix permissions on a few important folders:

```shell
chown apache:apache {bootstrap,storage,vendor} -R
```

Then exit from container:

```shell
exit
```

### 3. Finish

Login into container

```shell
docker-compose exec laravel bash
```

Create database and seed tables

```shell
php artisan migrate
php artisan db:seed
```

Then exit from container:

```shell
exit
```

## The End

Now you just need open following page http://localhost/graphql-playgroud in your browser.

Thanks for reading!
