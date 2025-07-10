.PHONY: run migrate rollback fresh

run:
	php artisan serve
	echo "Server is running at http://localhost:8000"

migrate:
	php artisan migrate
	echo "Migration completed."

rollback:
	php artisan migrate:rollback
	echo "Rollback completed."

fresh:
	php artisan migrate:fresh
	php artisan db:seed --class="AdminSeeder"
	echo "Database refreshed and seeded with admin data."