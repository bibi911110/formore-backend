<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Points_master;
use Faker\Generator as Faker;

$factory->define(Points_master::class, function (Faker $faker) {

    return [
        'schema' => $faker->word,
        'currency_id' => $faker->randomDigitNotNull,
        'ratio_of_collecting_points' => $faker->word,
        'ratio_for_cash_out' => $faker->word,
        'segments_id' => $faker->randomDigitNotNull,
        'levels_based_on_scenarios' => $faker->word,
        'birthday' => $faker->word,
        'welcome' => $faker->word,
        'fraud_of_points' => $faker->word,
        'campaign' => $faker->word,
        'start_date' => $faker->word,
        'end_date' => $faker->word,
        'choose_segments' => $faker->word,
        'expiration_date' => $faker->word,
        'message_eng' => $faker->word,
        'message_italian' => $faker->word,
        'message_greek' => $faker->word,
        'message_albanian' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
