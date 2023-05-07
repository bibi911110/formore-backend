<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Notification_details;
use Faker\Generator as Faker;

$factory->define(Notification_details::class, function (Faker $faker) {

    return [
        'notification_id' => $faker->randomDigitNotNull,
        'user_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
