<?php

use Setting\Item;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'setting_group_id' => 0,
        'name' => $faker->word,
        'description' => $faker->sentence,
        'key' => $faker->word,
        'value' => $faker->word,
        'autoload' => false
    ];
});