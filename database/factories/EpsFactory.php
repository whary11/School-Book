<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Eps;
use Faker\Generator as Faker;

$factory->define(Eps::class, function (Faker $faker) {
    return [
        'name' => $faker->name,

    ];
});
