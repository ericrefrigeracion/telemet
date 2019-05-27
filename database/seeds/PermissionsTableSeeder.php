<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//Roles
        Permission::create([
        	'name' => 'Listar roles',
        	'slug' => 'roles.index',
        	'description' => 'Listar y navegar todos sus roles',
        ]);
        Permission::create([
        	'name' => 'Ver rol',
        	'slug' => 'roles.show',
        	'description' => 'Ver informacion de un rol especifico',
        ]);
        Permission::create([
        	'name' => 'Crear rol',
        	'slug' => 'roles.create',
        	'description' => 'Crear un nuevo rol',
        ]);
        Permission::create([
        	'name' => 'Eliminar rol',
        	'slug' => 'roles.destroy',
        	'description' => 'Elimina un rol y toda su informacion',
        ]);
        Permission::create([
        	'name' => 'Editar roles',
        	'slug' => 'roles.edit',
        	'description' => 'Editar la informacion de un rol',
        ]);

        //Users
        Permission::create([
        	'name' => 'Listar usuarios',
        	'slug' => 'users.index',
        	'description' => 'Listar y navegar todos sus usuarios',
        ]);
        Permission::create([
        	'name' => 'Ver usuario',
        	'slug' => 'users.show',
        	'description' => 'Ver informacion de un usuario especifico',
        ]);
        Permission::create([
        	'name' => 'Eliminar usuario',
        	'slug' => 'users.destroy',
        	'description' => 'Elimina un usuario y toda su informacion',
        ]);
        Permission::create([
        	'name' => 'Editar usuarios',
        	'slug' => 'users.edit',
        	'description' => 'Editar la informacion de un usuario',
        ]);

    	//User-informations
        Permission::create([
        	'name' => 'Editar informacion',
        	'slug' => 'user-informations.edit',
        	'description' => 'Editar la informacion de su propio usuario',
        ]);

    	//Devices
        Permission::create([
        	'name' => 'Listar dispositivos',
        	'slug' => 'devices.index',
        	'description' => 'Listar y navegar todos sus dispositivos',
        ]);
        Permission::create([
        	'name' => 'Ver dispositivo',
        	'slug' => 'devices.show',
        	'description' => 'Ver informacion de un dispositivo especifico',
        ]);
        Permission::create([
        	'name' => 'Crear dispositivo',
        	'slug' => 'devices.create',
        	'description' => 'Crear un nuevo dispositivo',
        ]);
        Permission::create([
        	'name' => 'Eliminar dispositivo',
        	'slug' => 'devices.destroy',
        	'description' => 'Elimina un dispositivo y toda su informacion',
        ]);
        Permission::create([
        	'name' => 'Editar dispositivos',
        	'slug' => 'devices.edit',
        	'description' => 'Editar la informacion de un dispositivo',
        ]);

        //Device-configurations
        Permission::create([
        	'name' => 'Editar configuracion',
        	'slug' => 'device-configurations.edit',
        	'description' => 'Editar la configuracion de un dispositivo en particular',
        ]);

        //Receptions
        Permission::create([
        	'name' => 'Ver grafico',
        	'slug' => 'receptions.show',
        	'description' => 'Ver el grafico de un dispositivo',
        ]);


    }
}