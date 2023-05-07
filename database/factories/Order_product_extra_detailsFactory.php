<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order_product_extra_details;
use Faker\Generator as Faker;

$factory->define(Order_product_extra_details::class, function (Faker $faker) {

    return [
        'product_id' => $faker->randomDigitNotNull,
        'name' => $faker->word,
        'available_quantities' => $faker->randomDigitNotNull,
        'points_per_quantity' => $faker->randomDigitNotNull,
        'price_per_quantity' => $faker->randomDigitNotNull,
        'status' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
