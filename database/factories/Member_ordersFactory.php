<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Member_orders;
use Faker\Generator as Faker;

$factory->define(Member_orders::class, function (Faker $faker) {

    return [
        'member_name' => $faker->word,
        'member_id' => $faker->word,
        'order_details' => $faker->word,
        'delivery_address' => $faker->word,
        'member_comments' => $faker->word,
        'advance_payment' => $faker->word,
        'points' => $faker->randomDigitNotNull,
        'cash' => $faker->randomDigitNotNull,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
