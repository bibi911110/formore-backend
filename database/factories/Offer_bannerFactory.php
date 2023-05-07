<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Offer_banner;
use Faker\Generator as Faker;

$factory->define(Offer_banner::class, function (Faker $faker) {

    return [
        'offer_image' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
