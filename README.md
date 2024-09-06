## Steps:

1 - composer install

2 - touch database/database.sqlite

3 - create .env. file

4 - php artisan key:generate

5 - fill curtain fields below:

 - MONGODB_URI=
 - MONGODB_DB_NAME=
 - GOOGLE_DIRECTIONS_API_URL=
 - GOOGLE_DIRECTIONS_API_KEY=

6 - php artisan migrate --seed

7 - php artisan test
