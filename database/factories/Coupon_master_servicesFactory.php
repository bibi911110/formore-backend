<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Coupon_master_services;
use Faker\Generator as Faker;

$factory->define(Coupon_master_services::class, function (Faker $faker) {

    return [
        'coupon_code' => $faker->word,
        'start_date' => $faker->word,
        'end_date' => $faker->word,
        'amount_type' => $faker->word,
        'amount' => $faker->word,
        'amount_discount' => $faker->randomDigitNotNull,
        'points_discount' => $faker->randomDigitNotNull,
        'coupon_info' => $faker->text,
        'created_by' => $faker->randomDigitNotNull,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
