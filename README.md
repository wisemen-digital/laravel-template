## Packages

Below are the packages we installed on top of the default Laravel package:

- PEST PHP: Pest is a modern PHP Testing Framework with a focus on simplicity. It is designed to let you write tests in a style you're already familiar with. It is built on top of PHPUnit and provides a better testing experience.
- Spatie fractal: Spatie fractal is a package that helps you transform your Eloquent models and collections into a JSON API using fractal.
- Spatie media library: Spatie media library is a package that helps you manage the files that are associated with your Eloquent models.
- Laravel password: Laravel password is a package that helps you manage the password reset and email verification for your users.
- Laravel pint: Laravel pint is an opinionated PHP code style fixer for minimalists. Pint is built on top of PHP-CS-Fixer and makes it simple to ensure that your code style stays clean and consistent.
- PHPStan: PHPStan is a static analysis tool for your PHP code. It finds errors in your code without actually running it. It catches whole classes of bugs even before you write tests for the code. It moves PHP closer to compiled languages in the sense that the correctness of each line of the code can be checked before you run the actual line.
- Sentry: Sentry is a cross-platform application monitoring, with a focus on error reporting.

## Installation

Use the package manager [composer](https://getcomposer.org/) to install the project.

```
composer create-project appwise-labs/laravel-template project-name
cd project-name
```

## Usage

Before running the project

```
php artisan passport:keys
```

To use a temporary development database. This database is empty upon start, and will clear every reboot.
To clear this database, you can run npm run down
```
npm run up
```
To clear this database, you can run ```npm run down``` and ```npm run up``` again.

For local development run

```
php artisan serve
```

To fix code style

```
# Run pint and change the code
./vendor/bin/pint
or
npm run pint

# Run pint without changing the code
./vendor/bin/pint --test
or
npm run pint-test

# Run pint only on changed files
./vendor/bin/pint --dirty
or
npm run pint-dirty
```

To run your tests

```
./vendor/bin/pest
or
npm run test
```

TODO: To generate API documentation

```
php artisan ...
```

Before pushing to git, run PHPStan to analyse your code

```
./vendor/bin/phpstan analyse src tests
or
npm run phpstan
```

## Content

Below are the commands used to create this template:
```
# Create a new Laravel project
composer create-project laravel/laravel appwise-template

# PEST PHP
composer require phpunit/phpunit:^9.6 nunomaduro/collision:^6.1 --dev --with-all-dependencies
composer require pestphp/pest --dev --with-all-dependencies
composer require pestphp/pest-plugin-laravel --dev
php artisan pest:install

# Spatie fractal
composer require spatie/laravel-fractal
php artisan vendor:publish --provider="Spatie\Fractal\FractalServiceProvider"

# Spatie media library
composer require spatie/laravel-medialibrary
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="migrations"

# Laravel passport
composer require laravel/passport

# Laravel pint
composer require laravel/pint --dev

# PHPStan
composer require --dev phpstan/phpstan

# Sentry
composer require sentry/sentry-laravel
```
