# Laravel Setting Package

Setting boilerplate

## Installation

You can install the package via composer:

```bash
composer require macsidigital/laravel-setting
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

To set in config do the following

``` php
foreach(Group::where('identifier', 'membership')->first()->items as $item){
    config(['membership.'.$item->key => $item->value]);
}
```

#### Autoloading

There is also an autoload field which if set will automatically load the settings into config

``` php
$group = Group::create([
    'identifier' => "test",
    'name' => "Test Settings",
    'description' => "Test Settings and other things",
    'autoload' => true
]);
$item = Item::make(['key' => 'mailchimp.api', 'name' => 'Mailchimp Key', 'description' => 'Your Mailchimp API key so we can enable communication with your Mailchimp account']);
$group->items()->save($item);

Item::create(['key' => 'mailchimp.api', 'name' => 'Mailchimp Key', 'description' => 'Your Mailchimp API key so we can enable communication with your Mailchimp account', 'autoload' => true]);
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