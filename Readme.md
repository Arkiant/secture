# Start project

```
$ docker-compose up -d --build
$ docker exec -it secture_php_1 bash
$ composer update
```

# API docs

## Team

### Get all teams

```
GET http://localhost:8081/team HTTP/1.1

{

}
```

### Get single team

```
GET http://localhost:8081/team/{id} HTTP/1.1
```

### Create a team

```
POST http://localhost:8081/team HTTP/1.1

BODY:
{
   "name": "Test team"
}
```

### Update a team

```
PUT http://localhost:8081/team/{id} HTTP/1.1

BODY:
{
    "name": "New test name"
}
```

### Remove a team

```
DELETE http://localhost:8081/team/{id} HTTP/1.1
```

## Players

### Get all players

```
GET http://localhost:8081/player HTTP/1.1

{

}
```

Additional filters

```
GET http://localhost:8081/player?position=goalkeeper&team=5&currency=usd HTTP/1.1

{

}
```

### Get single player

```
GET http://localhost:8081/player/{id} HTTP/1.1
```

Additional filters:

```
GET http://localhost:8081/player/{id}?position=goalkeeper&team=5&currency=usd
```

### Create a player

```
POST http://localhost:8081/player HTTP/1.1

BODY:
{
   "name": "Test player",
    "price": 300,
    "team": 3,
    "position": "goalkeeper"
}
```

### Update a player

```
PUT http://localhost:8081/player/{id} HTTP/1.1

BODY:
{
    "name": "Test player",
    "price": 300,
    "team": 3,
    "position": "goalkeeper"
}
```

### Remove a player

```
DELETE http://localhost:8081/player/{id} HTTP/1.1
```

# Test execution

```
$ docker exec -it secture_php_1 bash
$ php bin/phpunit
```

# Steps to build php project

## Build docker

```
$ docker-compose up -d --build
```

## Restart a container

```
$ docker-compose up -d php
```

## Enter inside a php container to install packages

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
