<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Social_media_mgt;
use Faker\Generator as Faker;

$factory->define(Social_media_mgt::class, function (Faker $faker) {

    return [
        'media_name' => $faker->word,
        'media_category' => $faker->word,
        'media_icon' => $faker->word,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
