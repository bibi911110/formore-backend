<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Other_program_master;
use Faker\Generator as Faker;

$factory->define(Other_program_master::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'type_code' => $faker->word,
        'upload_photo' => $faker->word,
        'surname' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
