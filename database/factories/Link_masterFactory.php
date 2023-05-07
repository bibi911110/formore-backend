<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Link_master;
use Faker\Generator as Faker;

$factory->define(Link_master::class, function (Faker $faker) {

    return [
        'term_link' => $faker->word,
        'privacy_link' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
