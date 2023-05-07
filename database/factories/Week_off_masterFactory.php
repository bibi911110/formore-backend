<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Week_off_master;
use Faker\Generator as Faker;

$factory->define(Week_off_master::class, function (Faker $faker) {

    return [
        'day' => $faker->word,
        'status' => $faker->randomDigitNotNull,
        'created_by' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
