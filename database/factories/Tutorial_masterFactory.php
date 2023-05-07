<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tutorial_master;
use Faker\Generator as Faker;

$factory->define(Tutorial_master::class, function (Faker $faker) {

    return [
        'title' => $faker->word,
        'details' => $faker->text,
        'tutorial_video' => $faker->word,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
