# Build project

```
$ docker-compose up -d --build
```

# Restart a container

```
$ docker-compose up -d php
```

# Enter inside a php container to install packages

```
$ docker exec -it  secture_php_1 bash
```

## Installation symfony in docker

```
$ curl -sS https://get.symfony.com/cli/installer | bash
$ mv /root/.symfony/bin/symfony /usr/local/bin/symfony
$ symfony new symfony --dir=/var/www/symfony
```

## Install anotation routes beacuse is recommended way to configure routes by symfony.com

```
$ composer require annotations
```

## Installation doctrine

```
$ composer require symfony/orm-pack
$ composer require --dev symfony/maker-bundle
```

## Create database

```
$ php bin/console doctrine:database:create
```
