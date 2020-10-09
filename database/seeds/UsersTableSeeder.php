<?php

use App\User;
use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'User-Admin',
            'slug' => 'user.admin',
            'description' => 'Rol de usuario administrador',
            'special' => null
        ]);
        Role::create([
            'name' => 'User - Basic',
            'slug' => 'user.basic',
            'description' => 'Rol de usuario basico',
            'special' => null
        ]);
        Role::create([
            'name' => 'Denied',
            'slug' => 'user.denied',
            'description' => 'Rol sin permisos',
            'special' => 'no-access'
        ]);
        Role::create([
            'name' => 'Invitado',
            'slug' => 'user.invited',
            'description' => 'Rol de invitado',
            'special' => null
        ]);
        Role::create([
            'name' => 'Super-Admin',
            'slug' => 'super.admin',
            'description' => 'Rol de administracion',
            'special' => 'all-access'
        ]);

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
            'name' => 'Invitado',
            'email' => 'invitado@invitado.com',
            'email_verified_at' => now(),
            'password' => Hash::make('invitado'),
            'remember_token' => Str::random(10),
        ]);

    }
}
