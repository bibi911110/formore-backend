<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Gift_vocher_types;
use Faker\Generator as Faker;

$factory->define(Gift_vocher_types::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'status' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
