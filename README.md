# Laravel Authentication Log

[![Build Status](https://travis-ci.com/KeyShang/laravel-authentication-log.svg?branch=master)](https://travis-ci.com/KeyShang/laravel-authentication-log)
[![StyleCI](https://github.styleci.io/repos/369752648/shield?style=flat&branch=master)](https://github.styleci.io/repos/369752648)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/KeyShang/laravel-authentication-log/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/KeyShang/laravel-authentication-log/?branch=master)
[![Total Downloads](https://poser.pugx.org/keyshang/laravel-authentication-log/downloads)](//packagist.org/packages/keyshang/laravel-authentication-log)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg?style=flat)](https://raw.githubusercontent.com/KeyShang/laravel-authentication-log/master/LICENSE)

## Introduction
Inspired by [yadahan/laravel-authentication-log](https://github.com/yadahan/laravel-authentication-log).

To make package simple and clean, remove unnecessary record logout function, Slack notification, NexmoMessage notification.

Add translatable email function, and add Chinese translation. Translation of more languages is welcome to push.

Add some other code improvements.

## Installation

> The package requires Laravel 8.x, and PHP 7.2+.

You may use Composer to install Laravel Authentication Log into your Laravel project:

    composer require yadahan/laravel-authentication-log

### Configuration

After installing the Laravel Authentication Log, publish its config, migration and view, using the `vendor:publish` Artisan command:

    php artisan vendor:publish --provider="KeyShang\AuthenticationLog\AuthenticationLogServiceProvider"

Next, you need to migrate your database. The Laravel Authentication Log migration will create the table your application needs to store authentication logs:

    php artisan migrate

Finally, add the `AuthenticationLogable` and `Notifiable` traits to your authenticatable model (by default, `App\User` model). These traits provides various methods to allow you to get common authentication log data, such as last login time, last login IP address, and set the channels to notify the user when login from a new device:

```php
use Illuminate\Notifications\Notifiable;
use KeyShang\AuthenticationLog\AuthenticationLogable;
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

By default notify via email.

You can disable notification by set the `notify` option in your `config/authentication-log.php` configuration file to `false`:

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

## Previewing Mail Notifications
In routes file, add following code to preview your Mail template.

```php
Route::get('/notification', function () {
    $log = \KeyShang\AuthenticationLog\AuthenticationLog::first();
    $user = $log->authenticatable;
    return (new \KeyShang\AuthenticationLog\Notifications\NewDevice($log))
        ->toMail($user);
});
```

## Contributing

Thank you for considering contributing to the Laravel Authentication Log.

## License

Laravel Authentication Log is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
