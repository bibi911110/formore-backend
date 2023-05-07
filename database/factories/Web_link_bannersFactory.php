<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Web_link_banners;
use Faker\Generator as Faker;

$factory->define(Web_link_banners::class, function (Faker $faker) {

    return [
        'title' => $faker->word,
        'link' => $faker->word,
        'web_image' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
