<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Loyalty_banner_master;
use Faker\Generator as Faker;

$factory->define(Loyalty_banner_master::class, function (Faker $faker) {

    return [
        'terms_of_loyalty' => $faker->text,
        'schema' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
