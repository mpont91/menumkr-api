laravel:
	docker exec -it menumkr-laravel bash

fix:
	docker exec -it menumkr-laravel ./vendor/bin/pint

ci:
	docker exec -it menumkr-laravel ./vendor/bin/pint --test
	docker exec -it menumkr-laravel php artisan test