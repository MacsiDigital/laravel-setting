<?php

use Setting\Models\Group;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Group::class, function (Faker $faker) {
    return [
        'identifier' => $faker->word,
        'name' => $faker->word,
        'description' => $faker->sentence,
        'autoload' => false
    ];
});
