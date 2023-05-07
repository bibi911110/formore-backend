<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\App_screen_information;
use Faker\Generator as Faker;

$factory->define(App_screen_information::class, function (Faker $faker) {

    return [
        'screen_name' => $faker->word,
        'language_id' => $faker->randomDigitNotNull,
        'content' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
