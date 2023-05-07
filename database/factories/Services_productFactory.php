<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Services_product;
use Faker\Generator as Faker;

$factory->define(Services_product::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'product_img' => $faker->word,
        'price_per_slot' => $faker->randomDigitNotNull,
        'point_per_slot' => $faker->randomDigitNotNull,
        'created_by' => $faker->randomDigitNotNull,
        'status' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
