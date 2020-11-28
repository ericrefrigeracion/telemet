<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DataReception;
use Faker\Generator as Faker;

$factory->define(DataReception::class, function (Faker $faker) {
    return [
        'device_id' => 123456,
        'topic' => $faker->randomElement(['discharge_temp', 'ev_in_temp', 'liquid_line_temp', 'suction_temp', 'product_temp']),
        'value' => rand(0,30),
        'created_at' => $faker->dateTimeBetween($startDate = 'yesterday', $endDate = 'now', $timezone = null),
        'status' => '-'
    ];
});
