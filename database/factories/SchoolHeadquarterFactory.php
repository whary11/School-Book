<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SchoolHeadquarter;
use Faker\Generator as Faker;

$factory->define(SchoolHeadquarter::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'intititution_id' => \App\Institution::all()->random()->id
    ];
});
