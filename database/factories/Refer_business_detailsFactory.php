<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Refer_business_details;
use Faker\Generator as Faker;

$factory->define(Refer_business_details::class, function (Faker $faker) {

    return [
        'name_of_business' => $faker->word,
        'owner_email' => $faker->word,
        'your_name' => $faker->word,
        'your_email' => $faker->word,
        'term_check' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
