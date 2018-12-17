## About TSL-Wall-Backend

Based on these instructions: [TSL Wall Instructions](https://docs.google.com/document/d/1mCsQUHatIj7gEcGNq6Q3FurGotUHmu-HLtnc9Fe_vBc/edit#heading=h.2oxpcm7pwfsj)

This is the backend portion of the project and it is built with the following components;

- Laravel 5.7
- Broadcasting, via Pusher
- PHPUnit for feature level testing

## Requirements

- PHP 7.1+
- Composer
- Pusher account (API keys)

## Setup Process

- `git clone https://github.com/roerjo/tsl-wall-backend.git`
- Run `composer install`
- Generate `APP_KEY` via `php artisan generate:key`
- Setup the `.env` file
- Run `php artisan jwt:secret`
- Check permissions on `storage/logs`
- Run `php artisan migrate`

After the able is fininshed, the application should be accessible via a local server which can be started via `php artisan serve`.

## Tests

- Run `vendor/bin/phpunit --color tests/` to the run the testsuite
