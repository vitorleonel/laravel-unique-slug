# UniqueSlug for Laravel 5

Based on https://dotdev.co/creating-unique-title-slugs-with-laravel/

## About

The `laravel-unique-slug` generate a unique slug in your application on an eloquent model with have slug column.

## Installation

Require the `vitorleonel/laravel-unique-slug` package in your `composer.json` and update your dependencies:

```sh
$ composer require vitorleonel/laravel-unique-slug
```

Add the ServiceProvider to your `config/app.php` providers array:

```php
VitorLeonel\UniqueSlug\UniqueSlugServiceProvider::class,
```

## License

Released under the MIT License.