## Steps:

1 - composer install

2 - create .env file

3 - php artisan key:generate

4 - fill curtain fields below:

 - MONGODB_URI=
 - MONGODB_DB_NAME=
 - GOOGLE_DIRECTIONS_API_KEY=

5 - php artisan migrate --seed

6 - php artisan test
