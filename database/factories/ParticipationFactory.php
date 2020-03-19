<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Participation;
use Faker\Generator as Faker;

$factory->define(Participation::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        'value' => rand(1, 20)
    ];
});
