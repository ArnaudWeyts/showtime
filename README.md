#Project Serverside Webscripten 2
## To build and serve to localhost:8000, run:
```bash
# install components
npm install && bower install && composer install &&
# create an empty sqlite database
sqlite3 /showtime/storage/1516showtime.db "" &&
# migrate the database layout
php artisan migrate &&
# seed the default entries
php artisan migrate:refresh --seed &&
# serve to localhost
php artisan serve
```