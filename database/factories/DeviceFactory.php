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
        'location_lat' => $faker->latitude(),
        'location_lon' => $faker->longitude(),
        'monitor' => $faker->boolean,
        'user_id' => $user->random()->id,
    ];
});
