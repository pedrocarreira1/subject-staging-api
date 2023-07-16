
## Subject Staging API

The goal for this staging layer API is to manage the subjects, being an intermediate layer between an External 
System and the Core API as a standalone microservice.

## Requirements

This app is build with the latest php version as well as the latest version of Laravel framework.

This is a containerized solution therefore it is recommended to use **docker**.

## Development

For the environment file **.env** you can copy **.env.local**

For loading dependencies through composer, cd into the project folder and run:
```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

For starting the app, its containers and services, cd into the app and run from a unix terminal:
```shell
./vendor/bin/sail up -d
```

## Tests

For running tests, run from within project folder:
```shell
./vendor/bin/sail artisan test
```

## Documentation

For the API documentation of the subject staging API check the documentation folder with a Postman collection.
A swagger documentation is to be implemented in future releases.

For Laravel documentation:
- **[Laravel](https://laravel.com/docs/10.x)**

## Final Notes
I am convinced that a lot can be improved, however this is a small example that can meet the requirements.
