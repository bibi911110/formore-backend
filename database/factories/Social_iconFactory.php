<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Social_icon;
use Faker\Generator as Faker;

$factory->define(Social_icon::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'social_icon' => $faker->word,
        'link' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
