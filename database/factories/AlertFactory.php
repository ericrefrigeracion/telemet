<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Alert;
use App\Device;
use Faker\Generator as Faker;

$factory->define(Alert::class, function (Faker $faker) {
    $device = Device::all();
    return [
        'log' => $faker->sentence(5),
        'device_id' => $device->random()->id,
    ];
});
