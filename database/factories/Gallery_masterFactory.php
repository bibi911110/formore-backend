<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Gallery_master;
use Faker\Generator as Faker;

$factory->define(Gallery_master::class, function (Faker $faker) {

    return [
        'gallery_img' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
