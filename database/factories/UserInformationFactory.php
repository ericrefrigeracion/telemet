<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\User;
use App\UserInformation;
use Faker\Generator as Faker;

$factory->define(UserInformation::class, function (Faker $faker) {
    $user = User::all();
    return [
        'notification_mail' => $faker->safeEmail,
        'notification_phone' => $faker->phoneNumber,
        'payment_date' => now(),
        'user_id' => $user->random()->id,
    ];
});
