up:
	docker-compose up -d

stop:
	docker-compose stop

bash:
	docker-compose exec laravel.test bash

down:
	docker-compose down -v

migrate:
	./artisan migrate

fresh:
	./artisan migrate:fresh --seed

test:
	./artisan test
