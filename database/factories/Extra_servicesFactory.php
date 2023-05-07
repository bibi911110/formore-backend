<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Extra_services;
use Faker\Generator as Faker;

$factory->define(Extra_services::class, function (Faker $faker) {

    return [
        'services_name' => $faker->word,
        'services_per_price' => $faker->randomDigitNotNull,
        'services_per_point' => $faker->randomDigitNotNull,
        'status' => $faker->word,
        'created_by' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
