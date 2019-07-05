<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Pay;
use App\User;
use App\Device;
use Faker\Generator as Faker;

$factory->define(Pay::class, function (Faker $faker) {
	$users = User::all();
	$user_id = $users->random()->id;
	$devices = Device::where('user_id', $user_id)->get();
    return [
    	'user_id' => $user_id,
        'device_id' => $devices->random()->id,
        'method' => $faker->randomElement(['pagofacil', 'rapipago', 'redlink']),
        'status' => $faker->randomElement(['pendiente', 'acreditado', 'vencido']),
        'payer' => $faker->safeEmail,
        'vigent_until' => now(),
        'amount' => 650,
    ];
});
