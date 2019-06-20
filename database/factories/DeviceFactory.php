<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */
use App\User;
use App\Device;
use Faker\Generator as Faker;

$factory->define(Device::class, function (Faker $faker) {
	$user = User::all();
    return [
    	'id' => $faker->unique()->numberBetween(1000, 2999),
        'name' => $faker->sentence(3),
        'lat' => $faker->latitude(),
        'lon' => $faker->longitude(),
        'on_line' => $faker->boolean,
        'view_alerts_at' => now(),
        'admin_mon' => $faker->boolean,
        'send_mails' => $faker->boolean,
        'user_id' => $user->random()->id,
        'mdl' => $faker->randomElement(['th', 't']),
        'tmon' => $faker->boolean,
        'tmin' => $faker->numberBetween(-5,5),
        'tmax' => $faker->numberBetween(10,15),
        'tdly' => $faker->numberBetween(5,15),
        'tcal' => $faker->numberBetween(-2,3),
        'twatch' => null,
        'hmon' => $faker->boolean,
        'hmin' => $faker->numberBetween(30,50),
        'hmax' => $faker->numberBetween(60,80),
        'hdly' => $faker->numberBetween(5,15),
        'hcal' => $faker->numberBetween(-2,3),
        'hwatch' => null,
    ];
});
