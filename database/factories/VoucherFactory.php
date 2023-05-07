<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Voucher;
use Faker\Generator as Faker;

$factory->define(Voucher::class, function (Faker $faker) {

    return [
        'business_id' => $faker->word,
        'code' => $faker->word,
        'icon' => $faker->word,
        'image' => $faker->word,
        'banner_image' => $faker->word,
        'category_id' => $faker->randomDigitNotNull,
        'start_date' => $faker->word,
        'end_date' => $faker->word,
        'terms_eng' => $faker->text,
        'description_eng' => $faker->text,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
