<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Device;
use App\Reception;
use Faker\Generator as Faker;

$factory->define(Reception::class, function (Faker $faker) {
	$device = Device::all();
    return [
        'data01' => $faker->randomFloat(2, -10, 10),
        'rssi' => $faker->numberBetween(-50, -70),
        'log' => 200,
        'device_id' => $device->random()->id,
    ];
});
