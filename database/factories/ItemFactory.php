<?php

/** @var Factory $factory */

use App\Item;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'description' => $faker->text,
        'amount' => $faker->randomNumber(),
        'user_id' => factory(User::class)
    ];
});
