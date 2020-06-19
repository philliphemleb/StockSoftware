<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Filter;
use Faker\Generator as Faker;

$factory->define(Filter::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'description' => $faker->text,
        'created_by' => $faker->numberBetween(0, 150)
    ];
});
