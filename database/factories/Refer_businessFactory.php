<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Refer_business;
use Faker\Generator as Faker;

$factory->define(Refer_business::class, function (Faker $faker) {

    return [
        'title' => $faker->word,
        'refer_icon' => $faker->word,
        'refer_text' => $faker->text,
        'term_details' => $faker->text,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
