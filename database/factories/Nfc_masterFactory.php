<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Nfc_master;
use Faker\Generator as Faker;

$factory->define(Nfc_master::class, function (Faker $faker) {

    return [
        'nfc_code' => $faker->word,
        'nfc_url' => $faker->word,
        'linked_url' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
