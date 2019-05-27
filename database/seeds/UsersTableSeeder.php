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
    	User::create([
    		'name' => 'Eric',
    		'email' => 'ericlopezrefrigeracion@hotmail.com',
    		'email_verified_at' => now(),
    		'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
    		'remember_token' => Str::random(10),
    	]);
    	User::create([
    		'name' => 'Carlos',
    		'email' => 'cgavernet@gmail.com',
    		'email_verified_at' => now(),
    		'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
    		'remember_token' => Str::random(10),
    	]);
        Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'special' => 'all-access'
        ]);
    }
}