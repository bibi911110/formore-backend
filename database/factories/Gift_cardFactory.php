<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Gift_card;
use Faker\Generator as Faker;

$factory->define(Gift_card::class, function (Faker $faker) {

    return [
        'to_name' => $faker->word,
        'to_email' => $faker->word,
        'from_name' => $faker->word,
        'message' => $faker->word,
        'voucher_id' => $faker->randomDigitNotNull,
        'user_id' => $faker->randomDigitNotNull,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
