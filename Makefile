# ---------------------------------------------------------------------
# variables
# ---------------------------------------------------------------------

CONTAINER   := nginx php-fpm postgres mysql minio
WEB         := nginx
APP         := php-fpm
MYSQL       := mysql
POSTGRES    := postgres
APP_DIR     := src
LARAVEL_VER := 8.*
all:

# ---------------------------------------------------------------------
# docker-compose
# ---------------------------------------------------------------------

build:
	docker-compose build $(CONTAINER)

build-no-cache:
	docker-compose build --no-cache $(CONTAINER)

up:
	docker-compose up -d $(CONTAINER)

down:
	docker-compose down

balse:
	docker-compose down --rmi all --volumes

restart: down up

# ---------------------------------------------------------------------
# docker-compose exec 
# ---------------------------------------------------------------------

web:
	docker-compose exec $(WEB) ash

app:
	docker-compose exec --user=www-data $(APP) bash

mydb:
	docker-compose exec $(MYSQL) mysql -udefault -psecret

pgdb:
	docker-compose exec $(POSTGRES) psql -U default -d pg

mydb-bash:
	docker-compose exec $(MYSQL) bash

pgdb-bash:
	docker-compose exec $(POSTGRES) bash

# ---------------------------------------------------------------------
# Laravel
# ---------------------------------------------------------------------
install-laravel:
	docker-compose exec $(APP) composer create-project --prefer-dist "laravel/laravel=$(LARAVEL_VER)" .

test:
	docker-compose exec $(APP) ./vendor/bin/phpunit --testdox

migrate-fresh-seed:
	docker-compose exec $(APP) php artisan migrate:fresh --seed

permission:
	docker-compose exec $(APP) chmod -R 777 ./storage ./bootstrap/cache

# ---------------------------------------------------------------------
# Nuxt
# ---------------------------------------------------------------------

client:
	docker-compose exec $(WEB) ash -c 'cd ./client-resource && yarn run dev'

admin:
	docker-compose exec $(WEB) ash -c 'cd ./admin-resource && yarn run dev'

# ---------------------------------------------------------------------
# Database
# ---------------------------------------------------------------------

show-vals:
	docker-compose exec $(MYSQL) mysql -udefault -psecret -e 'show variables like "chara%";'
	docker-compose exec $(MYSQL) mysql -udefault -psecret -e 'show variables like "coll%";'
