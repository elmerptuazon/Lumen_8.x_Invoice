
## Notice

Lumen 8.x

I can't run middleware or custom authserviceprovider due to bug of $next($request) show Unable to resolve Route Handler. Manually declared auth per method.

## Steps

composer install
Copy .env.example file to .env on the root folder. You can type copy .env.example .env if using command prompt Windows or cp .env.example .env
Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
By default, the username is root and you can leave the password field empty
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
