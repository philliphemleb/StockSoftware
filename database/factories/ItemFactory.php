<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'description' => $faker->text,
        'amount' => $faker->randomNumber(),
        'created_by' => $faker->numberBetween(0, 150)
    ];
});
