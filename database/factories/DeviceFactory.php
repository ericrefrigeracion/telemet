<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\User;
use App\Device;
use Faker\Generator as Faker;

$factory->define(Device::class, function (Faker $faker) {
	$user = User::all();
    return [
    	'id' => $faker->unique()->numberBetween(1000, 2999),
        'name' => $faker->sentence(2),
        'description' => $faker->sentence(4),
        'rule_type' => $faker->randomElement(['Siempre Protegido', 'Protegido cuando cierro mi Comercio', 'Con horarios Permitidos (Perzonalizado)']),
        'lat' => $faker->latitude(),
        'lon' => $faker->longitude(),
        'on_line' => $faker->boolean,
        'protected' => $faker->boolean,
        'on_temp' => $faker->boolean,
        'on_hum' => $faker->boolean,
        'on_t_set_point' => $faker->boolean,
        'on_h_set_point' => $faker->boolean,
        'view_alerts_at' => now(),
        'admin_mon' => $faker->boolean,
        'send_mails' => $faker->boolean,
        'user_id' => $user->random()->id,
        'mdl' => 't',
        't_set_point' => $faker->numberBetween(5,10),
        't_is' => $faker->randomElement(['lower', 'higher']),
        't_change_at' => now(),
        'tmon' => $faker->boolean,
        'tmin' => $faker->numberBetween(-5,5),
        'tmax' => $faker->numberBetween(10,15),
        'tdly' => $faker->numberBetween(5,15),
        'tcal' => $faker->numberBetween(-2,3),
        'h_set_point' => $faker->numberBetween(5,10),
        'h_is' => $faker->randomElement(['lower', 'higher']),
        'h_change_at' => now(),
        'hmon' => $faker->boolean,
        'hmin' => $faker->numberBetween(30,50),
        'hmax' => $faker->numberBetween(60,80),
        'hdly' => $faker->numberBetween(5,15),
        'hcal' => $faker->numberBetween(-2,3),
        'monitor_expires_at' => now()->addWeek(),
    ];
});
