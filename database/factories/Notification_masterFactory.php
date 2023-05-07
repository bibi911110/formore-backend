<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Notification_master;
use Faker\Generator as Faker;

$factory->define(Notification_master::class, function (Faker $faker) {

    return [
        'title' => $faker->word,
        'details' => $faker->text,
        'notification_image' => $faker->word,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
