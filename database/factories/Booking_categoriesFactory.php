<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Booking_categories;
use Faker\Generator as Faker;

$factory->define(Booking_categories::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'status' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
