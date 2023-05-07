<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Brand;
use Faker\Generator as Faker;

$factory->define(Brand::class, function (Faker $faker) {

    return [
        'cat_id' => $faker->randomDigitNotNull,
        'sub_id' => $faker->randomDigitNotNull,
        'name' => $faker->word,
        'brand_icon' => $faker->word,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
