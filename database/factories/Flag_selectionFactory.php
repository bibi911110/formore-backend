<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Flag_selection;
use Faker\Generator as Faker;

$factory->define(Flag_selection::class, function (Faker $faker) {

    return [
        'buss_id' => $faker->randomDigitNotNull,
        'segment_id' => $faker->randomDigitNotNull,
        'user_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
