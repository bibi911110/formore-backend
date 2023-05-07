<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Promotional_image_master;
use Faker\Generator as Faker;

$factory->define(Promotional_image_master::class, function (Faker $faker) {

    return [
        'image_1' => $faker->word,
        'counter_1' => $faker->word,
        'image_2' => $faker->word,
        'counter_2' => $faker->word,
        'image_3' => $faker->word,
        'counter_3' => $faker->word,
        'image_4' => $faker->word,
        'counter_4' => $faker->word,
        'image_5' => $faker->word,
        'counter_5' => $faker->word,
        'from_date' => $faker->word,
        'to_date' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
