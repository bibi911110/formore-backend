<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User_voucher;
use Faker\Generator as Faker;

$factory->define(User_voucher::class, function (Faker $faker) {

    return [
        'voucher_id' => $faker->randomDigitNotNull,
        'user_id' => $faker->randomDigitNotNull,
        'user_credit' => $faker->word,
        'stamps' => $faker->randomDigitNotNull,
        'points' => $faker->randomDigitNotNull,
        'used_code_status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
