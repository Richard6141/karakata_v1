phpstan:
	vendor/bin/phpstan analyse --memory-limit=2G

insights:
	php artisan insights

insights-fix:
	php artisan insights --fix
