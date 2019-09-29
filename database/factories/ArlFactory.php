<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Arl;
use Faker\Generator as Faker;

$factory->define(Arl::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
