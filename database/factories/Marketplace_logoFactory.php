<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Marketplace_logo;
use Faker\Generator as Faker;

$factory->define(Marketplace_logo::class, function (Faker $faker) {

    return [
        'business_id' => $faker->randomDigitNotNull,
        'position' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
