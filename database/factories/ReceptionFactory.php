<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Device;
use App\Reception;
use Faker\Generator as Faker;

$factory->define(Reception::class, function (Faker $faker) {
	$device = Device::all();
    return [
        'data01' => $faker->randomFloat(2, -10, 10),
        'data02' => $faker->randomFloat(2, 60, 80),
        'rssi' => $faker->numberBetween(-50, -70),
        'log' => $faker->numberBetween(200, 206),
        'device_id' => $device->random()->id,
    ];
});
