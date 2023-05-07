<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Voucher_upload_receipt;
use Faker\Generator as Faker;

$factory->define(Voucher_upload_receipt::class, function (Faker $faker) {

    return [
        'business_id' => $faker->randomDigitNotNull,
        'user_id' => $faker->randomDigitNotNull,
        'voucher_id' => $faker->randomDigitNotNull,
        'vat_number' => $faker->word,
        'date_of_purchase' => $faker->word,
        'time' => $faker->word,
        'upload_receipt' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
