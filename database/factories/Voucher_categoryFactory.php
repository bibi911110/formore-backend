<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Voucher_category;
use Faker\Generator as Faker;

$factory->define(Voucher_category::class, function (Faker $faker) {

    return [
        'voucher_category' => $faker->word,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
