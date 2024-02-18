# IGD Tech Test Documentation

---

#### Foreward
The project is in no-means a production ready example and follows the directions given to the
letter (unless indicated that the example given has been modified in some way).

### Usage

After you have checked the project out from VCS, the first step you should take is to copy the `.env.example`
file to `.env` (e.g `cp .env.example .env`) before running the container (private repo so this is not ideal as it 
should be a deployable secret environment variable);

The database connection details are as follows:

```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=scrabble_friends
DB_USERNAME=root
DB_PASSWORD=igd
```

The demo runs on Docker (as supplied). Running `docker compose up -d` is enough to build the container image
and start the Laravel built-in webserver (running on port 8090 at [http://localhost:8090](http://localhost:8090)).
A setup with php-fpm + nginx running would have been more complete, but otherwise superfluous for this demo.
However, please note that the database has not been seeded at this point and accessing the site will result in empty 
data / UI.

To seed data into the database:

1. run `docker compose up -d`
2. run `docker compose exec igd php artisan migrate:fresh --seed --force` (force skips interactive mode meant for live 
first-time deploy)
3. Open your browser and visit [http://localhost:8090](http://localhost:8090)

## Testing

---

Some examples of optimistic and pessimistic tests have been written. 

Before running the tests, you will need to migrate the test database:

`docker compose exec igd php artisan migrate:fresh --database=testing`

The tests execute with phpunit:

`docker compose exec igd ./vendor/bin/phpunit`

Code coverage driver has been omitted for brevity. Tests don't contain unit tests, only feature tests.
