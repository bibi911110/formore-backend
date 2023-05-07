<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order_products;
use Faker\Generator as Faker;

$factory->define(Order_products::class, function (Faker $faker) {

    return [
        'cat_id' => $faker->randomDigitNotNull,
        'name' => $faker->word,
        'product_img' => $faker->word,
        'ingredients_name' => $faker->word,
        'available_quantities' => $faker->randomDigitNotNull,
        'price_per_quantity' => $faker->randomDigitNotNull,
        'points_per_quantity' => $faker->randomDigitNotNull,
        'status' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
