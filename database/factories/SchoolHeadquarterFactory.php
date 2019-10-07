<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SchoolHeadquarter;
use Faker\Generator as Faker;

$factory->define(SchoolHeadquarter::class, function (Faker $faker) {
    return [
        'code' => $faker->name,
        'institution_id' => \App\Institution::all()->random()->id
    ];
});
