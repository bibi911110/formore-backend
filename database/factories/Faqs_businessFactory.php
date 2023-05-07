<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Faqs_business;
use Faker\Generator as Faker;

$factory->define(Faqs_business::class, function (Faker $faker) {

    return [
        'question' => $faker->text,
        'answer' => $faker->text,
        'created_by' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
