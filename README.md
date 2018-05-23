# Generate the SQL for Laravel migrations

[![Build Status](https://travis-ci.org/josh-taylor/migrate-sql.svg?branch=master)](https://travis-ci.org/josh-taylor/migrate-sql)
[![Packagist](https://img.shields.io/packagist/dt/josh-taylor/migrate-sql.svg)](https://packagist.org/packages/josh-taylor/migrate-sql)

Sometimes it's not possible to run `php artisan migrate` and you have to manually run migrations.

This Laravel package adds a command to generate the SQL that a migration will use. It's a bit like the `--pretend` option for `php artisan migrate` but will show migrations that have already run.

## Installation

This package requires PHP 7 and Laravel 5.6 or higher.

You can install the package via composer using:

```
composer require josh-taylor/migrate-sql
```

This will automatically register the service provider and command.

## Usage

A new command will be added to your Laravel project.

```
php artisan migrate:sql
```

You can view the help screen for more options

```
php artisan migrate:sql -h
```

## Testing

Run the tests with:

```
vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
