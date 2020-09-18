# Laravel Setting

## Configs in the database

![Header Image](https://github.com/MacsiDigital/repo-design/raw/master/laravel-setting/header.png)

<p align="center">
 <a href="https://github.com/MacsiDigital/laravel-setting/actions?query=workflow%3ATests"><img src="https://github.com/MacsiDigital/laravel-setting/workflows/Tests/badge.svg" style="max-width:100%;"  alt="tests badge"></a>
 <a href="https://packagist.org/packages/macsidigital/laravel-setting"><img src="https://img.shields.io/packagist/v/macsidigital/laravel-setting.svg?style=flat-square" alt="version badge"/></a>
 <a href="https://packagist.org/packages/macsidigital/laravel-setting"><img src="https://img.shields.io/packagist/dt/macsidigital/laravel-setting.svg?style=flat-square" alt="downloads badge"/></a>
</p>

A setting package to save settings to the db and access them through config.

## Support us

We invest a lot in creating [open source packages](https://macsidigital.co.uk/open-source), and would be grateful for a [sponsor](https://github.com/sponsors/MacsiDigital) if you make money from your product that uses them.

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

As we utilise Eloquent you can use any Eloquent functions.  For example, do the following to retrieve a setting group.

``` php
Group::where('identifier', 'membership')->first();
```

We are linked to the items in the normal relationship way

``` php
foreach(Group::where('identifier', 'membership')->first()->items){
	// do something
}
```

## Auto loading

There's an autoload field, which if set will automatically load the settings into config

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

This will be automatically loaded when the Setting Service Provider is booted.

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security-related issues, please email [info@macsi.co.uk](mailto:info@macsi.co.uk) instead of using the issue tracker.

## Credits

- [Colin Hall](https://github.com/colinhall17)
- [MacsiDigital](https://github.com/MacsiDigital)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
