<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Question_answer;
use Faker\Generator as Faker;

$factory->define(Question_answer::class, function (Faker $faker) {

    return [
        'question_id' => $faker->randomDigitNotNull,
        'select_ans' => $faker->word,
        'range_ans' => $faker->randomDigitNotNull,
        'rating_ans' => $faker->word,
        'user_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
