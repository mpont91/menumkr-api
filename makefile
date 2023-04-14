laravel:
	docker exec -it menumkr-laravel bash

ci:
	docker exec -it menumkr-laravel ./vendor/bin/pint --test
	docker exec -it menumkr-laravel php artisan test