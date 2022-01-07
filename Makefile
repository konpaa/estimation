up:
	docker-compose up -d

stop:
	docker-compose stop

bash:
	docker-compose exec app bash

down:
	docker-compose down -v

migrate:
	./artisan migrate

fresh:
	./artisan migrate:fresh --seed

test:
	./artisan test

facade:
	php artisan ide-helper:generate

model:
	php artisan ide-helper:models "App\Models\Product" "App\Models\User"
