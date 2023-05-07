<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Slot_master;
use Faker\Generator as Faker;

$factory->define(Slot_master::class, function (Faker $faker) {

    return [
        'start_time' => $faker->word,
        'end_time' => $faker->word,
        'pepole_per_slot' => $faker->randomDigitNotNull,
        'price_per_slot' => $faker->randomDigitNotNull,
        'created_by' => $faker->randomDigitNotNull,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
