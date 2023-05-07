<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Purchase_options;
use Faker\Generator as Faker;

$factory->define(Purchase_options::class, function (Faker $faker) {

    return [
        'title' => $faker->word,
        'available' => $faker->word,
        'points' => $faker->word,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
