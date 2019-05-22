<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */
use App\Device;
use App\DeviceConfiguration;
use Faker\Generator as Faker;

$factory->define(DeviceConfiguration::class, function (Faker $faker) {
	$device = Device::all();
    return [
        'data01_mon' => $faker->boolean,
        'data01_min' => $faker->numberBetween(-5,5),
        'data01_max' => $faker->numberBetween(10,15),
        'data01_dly' => $faker->numberBetween(5,15),
        'data01_cal' => $faker->numberBetween(0,3),
        'data01_typ' => '°C',
        'data02_mon' => $faker->boolean,
        'data02_min' => $faker->numberBetween(-5,5),
        'data02_max' => $faker->numberBetween(10,15),
        'data02_dly' => $faker->numberBetween(5,15),
        'data02_cal' => $faker->numberBetween(0,3),
        'data02_typ' => '°C',
        'data03_mon' => $faker->boolean,
        'data03_min' => $faker->numberBetween(-5,5),
        'data03_max' => $faker->numberBetween(10,15),
        'data03_dly' => $faker->numberBetween(5,15),
        'data03_cal' => $faker->numberBetween(0,3),
        'data03_typ' => '°C',
        'data04_mon' => $faker->boolean,
        'data04_min' => $faker->numberBetween(-5,5),
        'data04_max' => $faker->numberBetween(10,15),
        'data04_dly' => $faker->numberBetween(5,15),
        'data04_cal' => $faker->numberBetween(0,3),
        'data04_typ' => '°C',
        'data05_mon' => $faker->boolean,
        'data05_min' => $faker->numberBetween(-5,5),
        'data05_max' => $faker->numberBetween(10,15),
        'data05_dly' => $faker->numberBetween(5,15),
        'data05_cal' => $faker->numberBetween(0,3),
        'data05_typ' => '°C',
        'data06_mon' => $faker->boolean,
        'data06_min' => $faker->numberBetween(-5,5),
        'data06_max' => $faker->numberBetween(10,15),
        'data06_dly' => $faker->numberBetween(5,15),
        'data06_cal' => $faker->numberBetween(0,3),
        'data06_typ' => '°C',
        'data07_mon' => $faker->boolean,
        'data07_min' => $faker->numberBetween(-5,5),
        'data07_max' => $faker->numberBetween(10,15),
        'data07_dly' => $faker->numberBetween(5,15),
        'data07_cal' => $faker->numberBetween(0,3),
        'data07_typ' => '°C',
        'data08_mon' => $faker->boolean,
        'data08_min' => $faker->numberBetween(-5,5),
        'data08_max' => $faker->numberBetween(10,15),
        'data08_dly' => $faker->numberBetween(5,15),
        'data08_cal' => $faker->numberBetween(0,3),
        'data08_typ' => '°C',


        'device_id' => $device->random()->id,
    ];
});
