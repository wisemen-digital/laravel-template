# Project Name

[Include a brief description or introduction of your project here]

## Table of Contents

- [Installation](#installation)
- [Environment variables](#environment-variables)
- [Credentials](#credentials)
- [Usage](#usage)
- [Features](#features)
- [Entry points](#entry-points)
- [Production Setup](#production-setup)
- [Site URLs](#site-urls)
- [Documentation](#documentation)

## Installation

[Provide instructions on how to install and set up your Laravel project. Include any dependencies or prerequisites that need to be installed and how to obtain them.]

```
composer create-project appwise-labs/laravel-template project-name
cd project-name
```
## Environment variables
Set up the following environment variables in your .env file:
```
TEST_ENV_VARIABLE=example_value
```
## Credentials
You can find the credentials for this project in 1password or on confluence: [link to confluence page]

## Usage
[Explain how to use your Laravel project, including any important commands or features. Provide examples and instructions for common tasks.]

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

>>>>>>> 530a01936b9df508586b6ce42ddfb0b345d4ab78
Before pushing to git, run PHPStan to analyse your code

```
./vendor/bin/phpstan analyse src tests
or
npm run phpstan
```

## Features

[List the main features or functionalities of your Laravel project. You can provide a brief description of each feature and explain how it benefits the users or developers.]

- Feature 1: [Description]
- Feature 2: [Description]
- Feature 3: [Description]

## Entry points

[Provide a list of entry points for your Laravel project. These are the routes that can be accessed by the user. Include a brief description of each route.]

## Production Setup

[Provide instructions on how to set up your Laravel project for production. Include any dependencies or prerequisites that need to be installed and how to obtain them.]

## Site URLs

<<<<<<< HEAD
- Production URL: [URL]
- Staging URL: [URL]
- Testing URL: [URL]
- Development URL: [URL]

## Documentation

[Provide a link to the documentation for your Laravel project. This can be a link to a Confluence page.]

# Sentry
composer require sentry/sentry-laravel
```
>>>>>>> 530a01936b9df508586b6ce42ddfb0b345d4ab78
