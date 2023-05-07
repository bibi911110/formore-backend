<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Booked_services;
use Faker\Generator as Faker;

$factory->define(Booked_services::class, function (Faker $faker) {

    return [
        'member_name' => $faker->word,
        'member_id' => $faker->word,
        'service_name' => $faker->word,
        'booking_service_date_time' => $faker->word,
        'comments' => $faker->word,
        'advance_payment' => $faker->randomDigitNotNull,
        'status' => $faker->word,
        'created_by' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
