<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User_business_details;
use Faker\Generator as Faker;

$factory->define(User_business_details::class, function (Faker $faker) {

    return [
        'user_id' => $faker->word,
        'header_banner' => $faker->word,
        'business_name' => $faker->word,
        'map_link' => $faker->word,
        'user_available_points' => $faker->randomDigitNotNull,
        'e_shop_banner' => $faker->word,
        'booking_banner' => $faker->word,
        'logo' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
