# Set up:
php artisan migrate


# Database seeder for tests

```bash
composer dump-autoload
php artisan db:seed

php artisan migrate:reset
php artisan migrate
php artisan db:seed
```
