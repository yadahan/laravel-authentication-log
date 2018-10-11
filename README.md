# Laravel Authentication Log

[![Build Status](https://travis-ci.org/yadahan/laravel-authentication-log.svg?branch=master)](https://travis-ci.org/yadahan/laravel-authentication-log)
[![StyleCI](https://styleci.io/repos/103927645/shield?branch=master&style=flat)](https://styleci.io/repos/103927645)
[![Quality Score](https://img.shields.io/scrutinizer/g/yadahan/laravel-authentication-log.svg?style=flat)](https://scrutinizer-ci.com/g/yadahan/laravel-authentication-log)
[![Total Downloads](https://poser.pugx.org/yadahan/laravel-authentication-log/downloads?format=flat)](https://packagist.org/packages/yadahan/laravel-authentication-log)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg?style=flat)](https://raw.githubusercontent.com/yadahan/laravel-authentication-log/master/LICENSE)

## Installation

> Laravel Authentication Log requires Laravel 5.5 or higher, and PHP 7.0+.

You may use Composer to install Laravel Authentication Log into your Laravel project:

    composer require yadahan/laravel-authentication-log

### Configuration

After installing the Laravel Authentication Log, publish its config, migration and view, using the `vendor:publish` Artisan command:

    php artisan vendor:publish --provider="Yadahan\AuthenticationLog\AuthenticationLogServiceProvider"

Next, you need to migrate your database. The Laravel Authentication Log migration will create the table your application needs to store authentication logs:

    php artisan migrate

Finally, add the `AuthenticationLogable` and `Notifiable` traits to your authenticatable model (by default, `App\User` model). These traits provides various methods to allow you to get common authentication log data, such as last login time, last login IP address, and set the channels to notify the user when login from a new device:

```php
use Illuminate\Notifications\Notifiable;
use Yadahan\AuthenticationLog\AuthenticationLogable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, AuthenticationLogable;
}
```

### Basic Usage

Get all authentication logs for the user:

```php
User::find(1)->authentications;
```

Get the user last login info:

```php
User::find(1)->lastLoginAt();

User::find(1)->lastLoginIp();
```

Get the user previous login time & ip address (ignoring the current login):

```php
auth()->user()->previousLoginAt();

auth()->user()->previousLoginIp();
```

### Notify login from a new device

Notifications may be sent on the `mail`, `nexmo`, and `slack` channels. By default notify via email.

You may define `notifyAuthenticationLogVia` method to determine which channels the notification should be delivered on:

```php
/**
 * The Authentication Log notifications delivery channels.
 *
 * @return array
 */
public function notifyAuthenticationLogVia()
{
    return ['nexmo', 'mail', 'slack'];
}
```

Of course you can disable notification by set the `notify` option in your `config/authentication-log.php` configuration file to `false`:

```php
'notify' => env('AUTHENTICATION_LOG_NOTIFY', false),
```

### Clear old logs

You may clear the old authentication log records using the `authentication-log:clear` Artisan command:

    php artisan authentication-log:clear

Records that is older than the number of days specified in the `older` option in your `config/authentication-log.php` will be deleted:

```php
'older' => 365,
```

## Contributing

Thank you for considering contributing to the Laravel Authentication Log.

## License

Laravel Authentication Log is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
