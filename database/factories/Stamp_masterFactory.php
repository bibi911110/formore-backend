<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Stamp_master;
use Faker\Generator as Faker;

$factory->define(Stamp_master::class, function (Faker $faker) {

    return [
        'business_id' => $faker->randomDigitNotNull,
        'country_id' => $faker->randomDigitNotNull,
        'stapm_point' => $faker->randomDigitNotNull,
        'image_of_loyalty_card' => $faker->word,
        'setup_level' => $faker->word,
        'daily_limit' => $faker->word,
        'welcome_stamp' => $faker->word,
        'birthday_step' => $faker->word,
        'bonus_stamp' => $faker->word,
        'stapm_expired' => $faker->word,
        'point_per_stamp' => $faker->word,
        'currency' => $faker->randomDigitNotNull,
        'ration_of_cash_out' => $faker->word,
        'message_eng' => $faker->text,
        'message_italian' => $faker->text,
        'message_greek' => $faker->text,
        'message_albanian' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
