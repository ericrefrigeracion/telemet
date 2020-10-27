<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::create([
    		'name' => 'Eric',
            'surname' => 'Lopez',
            'dni' => 32292512,
            'phone_area_code' => 3385,
            'phone_number' => 470666,
    		'email' => 'ericlopezrefrigeracion@gmail.com',
    		'email_verified_at' => now(),
    		'password' => Hash::make('2707brlo'),
    		'remember_token' => Str::random(10),
            'address' => 'Barzola 49'
    	]);
    	User::create([
    		'name' => 'Carlos A.',
            'surname' => 'Gavernet',
            'dni' => 28962129,
            'phone_area_code' => 3385,
            'phone_number' => 400879,
    		'email' => 'carlosgavernet@gmail.com',
    		'email_verified_at' => now(),
    		'password' => Hash::make('pic16f84a'),
    		'remember_token' => Str::random(10),
            'address' => 'Sarmiento 4'
    	]);
        User::create([
            'name' => 'Sergio',
            'surname' => 'Zorza',
            'dni' => 21654314,
            'phone_area_code' => 3385,
            'phone_number' => 590495,
            'email' => 'savoyeventos@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$mHHjujpa2BP8icQgEFcXwO1rxHVjnfJctQfavGegxctbTLFi9/M76',
            'remember_token' => Str::random(10),
            'address' => 'Alberdi 557 - Laboulaye (Cba)'
        ]);
        User::create([
            'name' => 'Alberto',
            'surname' => 'Biancotti',
            'dni' => 8473605,
            'phone_area_code' => 3385,
            'phone_number' => 590644,
            'email' => 'albertobiancotti@gmail.com',
            'email_verified_at' => now(),
            //'password' => '$2y$10$FNWT.UZegM/ceMyVHEvJqOhwxsygDMWDjscRNiKo7JQEyS.qX3xFK',
            'password' => Hash::make('2707brlo'),
            'remember_token' => Str::random(10),
            'address' => 'Belgrano 431 - Jovita(Cba)'
        ]);
        User::create([
            'name' => 'Marcelo',
            'surname' => 'Porcel',
            'phone_area_code' => 2364,
            'phone_number' => 676982,
            'email' => 'porcelmarcelo@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$H.E64vj6vQzIAQFVP9.jte10dqrQ1ngwRtfrBGkL3BquH.Ajqw/8G',
            'remember_token' => Str::random(10),
            'address' => 'Mitre y Pellegrini - Laboulaye (Cba)',
        ]);
        User::create([
            'name' => 'Marcela',
            'surname' => 'Arrieta',
            'phone_area_code' => 3385,
            'phone_number' => 406439,
            'email' => 'marcela_a_arrieta@yahoo.com.ar',
            'email_verified_at' => now(),
            'password' => '$2y$10$X91zFwBOcb0n92FgfJ1Ma.gJjMsMM5xj4u1wFFfW4jw...',
            'remember_token' => Str::random(10),
            'address' => 'Sarmiento 4',
        ]);
        User::create([
            'name' => 'Nestor',
            'surname' => 'Renaudo',
            'phone_area_code' => 3385,
            'phone_number' => 437478,
            'email' => 'nestorrenaudo@yahoo.com.ar',
            'email_verified_at' => now(),
            'password' => '$2y$10$6kkuQAcQPv18/p/FINYDM.wDSen8B1AmXo4bp4miLjs...',
            'remember_token' => Str::random(10),
            'address' => 'Juan A Mas y Fleury',
        ]);
        User::create([
            'name' => 'Esteban',
            'surname' => 'Giordano',
            'phone_area_code' => 3385,
            'phone_number' => 680537,
            'email' => 'estebangiord@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$9mJONDm2WQfuPrux0qPhrOMImuQZnVZqabeZ7i4CKPS...',
            'remember_token' => Str::random(10),
            'address' => 'Serrano'
        ]);
        User::create([
            'name' => 'Grupo',
            'surname' => 'Tesis',
            'phone_area_code' => 351,
            'phone_number' => 3892439,
            'email' => 'viottiaugusto@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$6kkuQAcQPv18/p/FINYDM.wDSen8B1AmXo4bp4miLjs...',
            'remember_token' => Str::random(10),
        ]);


    }
}
