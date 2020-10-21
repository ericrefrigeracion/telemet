<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DataReception;
use Faker\Generator as Faker;

$factory->define(DataReception::class, function (Faker $faker) {
    return [
        'device_id' => 123456,
        'topic' => $faker->randomElement(['temp1']),
        'value' => rand(0,10),
        'created_at' => $faker->dateTimeBetween($startDate = 'yesterday', $endDate = 'now', $timezone = null),
    ];
});
