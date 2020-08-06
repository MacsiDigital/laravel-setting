# Laravel Setting Package

## Configs in the database

![Header Image](https://github.com/MacsiDigital/repo-design/raw/master/laravel-setting/header.png)

<p align="center">
 <a href="https://github.com/MacsiDigital/laravel-setting/actions?query=workflow%3Atests"><img src="https://github.com/MacsiDigital/laravel-setting/workflows/Run%20tests/badge.svg" style="max-width:100%;"></a>
 <a href="https://packagist.org/packages/macsidigital/laravel-setting"><img src="https://img.shields.io/packagist/v/macsidigital/laravel-setting.svg?style=flat-square"/></a>
 <a href="https://packagist.org/packages/macsidigital/laravel-setting"><img src="https://img.shields.io/packagist/dt/macsidigital/laravel-setting.svg?style=flat-square"/></a>
</p>

A setting package to save settings to teh db and access them through config.

## Installation

This package can be used in Laravel 6.0 or higher.

You can install the package via composer:

```bash
composer require macsidigital/laravel-setting
```

You must publish the migration with:

``` bash
php artisan vendor:publish --tag="setting-migrations"
```

## Usage

You can save groups and settings like so

``` php
$group = Group::create([
    'identifier' => "test",
    'name' => "Test Settings",
    'description' => "Test Settings and other things"
]);
$item = Item::make(['key' => 'mailchimp', 'name' => 'Mailchimp Key', 'description' => 'Your Mailchimp API key so we can enable communication with your Mailchimp account']);
$group->items()->save($item);
```

As we utilise Eloquent you can use any Eloquent functions.  For exampledo the following to retreive a setting group

``` php
Group::where('identifier', 'membership')->first();
```

And we are linked to the items in the normal relationship way

``` php
foreach(Group::where('identifier', 'membership')->first()->items){
	// do something
}
```

## Autoloading

There is also an autoload field which if set will automatically load the settings into config

``` php
$group = Group::create([
    'identifier' => "test",
    'name' => "Test Settings",
    'description' => "Test Settings and other things",
    'autoload' => true
]);
$item = Item::make(['key' => 'mailchimp.api', 'name' => 'Mailchimp Key', 'description' => 'Your Mailchimp API key so we can enable communication with your Mailchimp account', 'autoload' => true]);
$group->items()->save($item);

// Access with
config('test.mailchimp.api');
```

These will be automatically loaded when the Setting Service Provider is run.

### Testing

``` bash
phpunit
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Credits

- [Colin Hall](https://github.com/colinhall17)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
