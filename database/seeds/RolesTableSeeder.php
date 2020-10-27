<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class RolesTableSeeder extends Seeder
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
            'description' => 'Rol de usuario con acceso total',
            'special' => null
        ]);
        Role::create([
            'name' => 'User-Med',
            'slug' => 'user.medium',
            'description' => 'Rol de usuario con acceso medio',
            'special' => null
        ]);
        Role::create([
            'name' => 'User-Basic',
            'slug' => 'user.basic',
            'description' => 'Rol de usuario sin acceso',
            'special' => null
        ]);
        Role::create([
            'name' => 'Denied',
            'slug' => 'user.denied',
            'description' => 'Rol sin permisos',
            'special' => 'no-access'
        ]);
        Role::create([
            'name' => 'Super-Admin',
            'slug' => 'super.admin',
            'description' => 'Rol de super user administrador',
            'special' => 'all-access'
        ]);
    }
}
