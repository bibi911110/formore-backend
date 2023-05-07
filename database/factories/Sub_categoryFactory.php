<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Sub_category;
use Faker\Generator as Faker;

$factory->define(Sub_category::class, function (Faker $faker) {

    return [
        'cat_id' => $faker->randomDigitNotNull,
        'name' => $faker->word,
        'icon' => $faker->word,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
