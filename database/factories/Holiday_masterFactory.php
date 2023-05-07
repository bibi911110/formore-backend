<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Holiday_master;
use Faker\Generator as Faker;

$factory->define(Holiday_master::class, function (Faker $faker) {

    return [
        'date' => $faker->word,
        'created_by' => $faker->randomDigitNotNull,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
