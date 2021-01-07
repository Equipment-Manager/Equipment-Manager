## Equipment Manager
Create `.env` file based on '.env.example':
```shell script
cp .env.example .env
```

###Run containers:
```shell script
docker-compose up -d --build
```

###Install Dependencies:
```shell script
docker-compose exec php composer install 
```

###Generate application key:
```shell script 
docker-compose exec php php artisan key:generate
```

###Run migrations:
```shell script
docker-compose exec php php artisan migrate
```
with seeders:
```shell script
docker-compose exec php php artisan migrate --seed
```

###Development commands
####PHP
Replace `*` with command
```shell script
docker-compose exec php php *
```
e.g:
```shell script
docker-compose exec php php artisan migrate
```

####Composer
Replace `*` with command
```shell script
docker-compose exec php composer *
```
e.g:
```shell script
docker-compose exec php composer install 
docker-compose exec php composer require
```

###ECS
Run ecs with following command:
```shell script
docker-compose exec php ./vendor/bin/ecs check
```
Add flag `--fix`, to apply all the fixers, like so:
```shell script
docker-compose exec php ./vendor/bin/ecs check --fix
```

###Tests
Run Behat:
```shell script
docker-compose exec php ./vendor/bin/behat
```

###Psalm
Run Psalm:
```shell script
docker-compose exec php ./vendor/bin/psalm
```
