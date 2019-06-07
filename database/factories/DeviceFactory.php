<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */
use App\User;
use App\Device;
use Faker\Generator as Faker;

$factory->define(Device::class, function (Faker $faker) {
	$user = User::all();
    return [
    	'id' => $faker->unique()->numberBetween(4000, 8000),
        'name' => $faker->sentence(3),
        'lat' => $faker->latitude(),
        'lon' => $faker->longitude(),
        'mon' => $faker->boolean,
        'min' => $faker->numberBetween(-5,5),
        'max' => $faker->numberBetween(10,15),
        'dly' => $faker->numberBetween(5,15),
        'cal' => $faker->numberBetween(-2,3),
        'admin_mon' => $faker->boolean,
        'on_line' => $faker->boolean,
        'mail_send' => $faker->boolean,
        'view_alerts_at' => now(),
        'watch' => null,
        'user_id' => $user->random()->id,
    ];
});
