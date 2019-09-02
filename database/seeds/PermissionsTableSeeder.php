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
    	//Devices
        Permission::create([
            'id' => 100,
        	'name' => 'Listar dispositivos de un usuario',
        	'slug' => 'devices.index',
        	'description' => 'Listar y navegar todos sus dispositivos',
        ]);
        Permission::create([
            'id' => 101,
            'name' => 'Listar todos los dispositivos de todos los usuarios',
            'slug' => 'devices.all',
            'description' => 'Listar y navegar todos los dispositivos existentes',
        ]);
        Permission::create([
            'id' => 102,
        	'name' => 'Ver dispositivo',
        	'slug' => 'devices.show',
        	'description' => 'Ver informacion de un dispositivo especifico',
        ]);
        Permission::create([
            'id' => 103,
            'name' => 'Ver log',
            'slug' => 'devices.log',
            'description' => 'Ver informacion log de un dispositivo especifico',
        ]);
        Permission::create([
            'id' => 104,
        	'name' => 'Crear dispositivo',
        	'slug' => 'devices.create',
        	'description' => 'Crear un nuevo dispositivo',
        ]);
        Permission::create([
            'id' => 105,
        	'name' => 'Eliminar dispositivo',
        	'slug' => 'devices.destroy',
        	'description' => 'Elimina un dispositivo y toda su informacion',
        ]);
        Permission::create([
            'id' => 106,
        	'name' => 'Editar dispositivo',
        	'slug' => 'devices.edit',
        	'description' => 'Editar la informacion de un dispositivo',
        ]);

        //Alerts
        Permission::create([
            'id' => 110,
            'name' => 'Listar alertas de un usuario',
            'slug' => 'alerts.index',
            'description' => 'Ver todas las alertas de un usuario',
        ]);
        Permission::create([
            'id' => 111,
            'name' => 'Listar alertas de un dispositivo',
            'slug' => 'alerts.show',
            'description' => 'Ver todas las alertas de un dispositivo',
        ]);
        Permission::create([
            'id' => 112,
            'name' => 'Listar todas las alertas de todos los usuarios',
            'slug' => 'alerts.all',
            'description' => 'Listar y navegar todas las alertas ocurridas organizadas por dispositivo',
        ]);


        //Receptions
        Permission::create([
            'id' => 120,
        	'name' => 'Ver ultima hora',
        	'slug' => 'receptions.show-hour',
        	'description' => 'Ver el grafico de la ultima hora de un dispositivo',
        ]);
        Permission::create([
            'id' => 121,
            'name' => 'Ver ultimo dia',
            'slug' => 'receptions.show-day',
            'description' => 'Ver el grafico del ultimo dia de un dispositivo',
        ]);
        Permission::create([
            'id' => 122,
            'name' => 'Ver ultima semana',
            'slug' => 'receptions.show-week',
            'description' => 'Ver el grafico de la ultima semana de un dispositivo',
        ]);
        Permission::create([
            'id' => 123,
            'name' => 'Ver ultimo mes',
            'slug' => 'receptions.show-month',
            'description' => 'Ver el grafico delultimo mes de un dispositivo',
        ]);
        Permission::create([
            'id' => 124,
            'name' => 'Ver todos los datos',
            'slug' => 'receptions.show-all',
            'description' => 'Ver el grafico de todos los datos de un dispositivo',
        ]);

        //Pays
        Permission::create([
            'id' => 130,
            'name' => 'Ver sus pagos',
            'slug' => 'pays.index',
            'description' => 'Ver los pagos de un usuario',
        ]);
        Permission::create([
            'id' => 131,
            'name' => 'Ver un pago',
            'slug' => 'pays.show',
            'description' => 'Ver un pago especifico de un usuario',
        ]);
        Permission::create([
            'id' => 132,
            'name' => 'Pagar',
            'slug' => 'pays.create',
            'description' => 'Crear un pago para un dispositivo',
        ]);
        Permission::create([
            'id' => 133,
            'name' => 'Ver todos los pagos',
            'slug' => 'pays.all',
            'description' => 'Ver todos los pagos de todos los usuarios',
        ]);

        //Rules
        Permission::create([
            'id' => 140,
            'name' => 'Listar reglas',
            'slug' => 'rules.index',
            'description' => 'Listar y navegar todas las reglas',
        ]);
        Permission::create([
            'id' => 141,
            'name' => 'Ver regla',
            'slug' => 'rules.show',
            'description' => 'Ver informacion de una regla especifica',
        ]);
        Permission::create([
            'id' => 142,
            'name' => 'Crear regla',
            'slug' => 'rules.create',
            'description' => 'Crear una nueva regla',
        ]);
        Permission::create([
            'id' => 143,
            'name' => 'Eliminar regla',
            'slug' => 'rules.destroy',
            'description' => 'Elimina una regla y toda su informacion',
        ]);
        Permission::create([
            'id' => 144,
            'name' => 'Editar regla',
            'slug' => 'rules.edit',
            'description' => 'Editar la informacion de una regla',
        ]);

        //Webhooks
        Permission::create([
            'id' => 200,
            'name' => 'Ver WebHooks',
            'slug' => 'webhooks.index',
            'description' => 'Ver todos los webhooks de la plataforma',
        ]);
        Permission::create([
            'id' => 201,
            'name' => 'Ver WebHook',
            'slug' => 'webhooks.show',
            'description' => 'Ver un webhook especifico',
        ]);

        //MailAlerts
        Permission::create([
            'id' => 210,
            'name' => 'Listar MailAlerts',
            'slug' => 'mail-alerts.index',
            'description' => 'Ver todas las alertas por Email de la plataforma',
        ]);
        Permission::create([
            'id' => 211,
            'name' => 'Ver MailAlerts',
            'slug' => 'mail-alerts.show',
            'description' => 'Ver una alerta por Email especifica',
        ]);

        //Prices
        Permission::create([
            'id' => 220,
            'name' => 'Listar precios',
            'slug' => 'prices.index',
            'description' => 'Listar y navegar todos los precios',
        ]);
        Permission::create([
            'id' => 221,
            'name' => 'Ver precio',
            'slug' => 'prices.show',
            'description' => 'Ver informacion de un precio especifico',
        ]);
        Permission::create([
            'id' => 222,
            'name' => 'Crear precio',
            'slug' => 'prices.create',
            'description' => 'Crear un nuevo precio',
        ]);
        Permission::create([
            'id' => 223,
            'name' => 'Eliminar precio',
            'slug' => 'prices.destroy',
            'description' => 'Elimina un precio y toda su informacion',
        ]);
        Permission::create([
            'id' => 224,
            'name' => 'Editar precio',
            'slug' => 'prices.edit',
            'description' => 'Editar la informacion de un precio',
        ]);

        //Roles
        Permission::create([
            'id' => 230,
            'name' => 'Listar roles',
            'slug' => 'roles.index',
            'description' => 'Listar y navegar todos los roles',
        ]);
        Permission::create([
            'id' => 231,
            'name' => 'Ver rol',
            'slug' => 'roles.show',
            'description' => 'Ver informacion de un rol especifico',
        ]);
        Permission::create([
            'id' => 232,
            'name' => 'Crear rol',
            'slug' => 'roles.create',
            'description' => 'Crear un nuevo rol',
        ]);
        Permission::create([
            'id' => 233,
            'name' => 'Eliminar rol',
            'slug' => 'roles.destroy',
            'description' => 'Elimina un rol y toda su informacion',
        ]);
        Permission::create([
            'id' => 234,
            'name' => 'Editar rol',
            'slug' => 'roles.edit',
            'description' => 'Editar la informacion de un rol',
        ]);

        //Users
        Permission::create([
            'id' => 240,
            'name' => 'Listar usuarios',
            'slug' => 'users.index',
            'description' => 'Listar y navegar todos los usuarios',
        ]);
        Permission::create([
            'id' => 241,
            'name' => 'Ver usuario',
            'slug' => 'users.show',
            'description' => 'Ver informacion de un usuario especifico',
        ]);
        Permission::create([
            'id' => 242,
            'name' => 'Eliminar usuario',
            'slug' => 'users.destroy',
            'description' => 'Elimina un usuario y toda su informacion',
        ]);
        Permission::create([
            'id' => 243,
            'name' => 'Editar usuario',
            'slug' => 'users.edit',
            'description' => 'Editar la informacion de un usuario',
        ]);
        Permission::create([
            'id' => 244,
            'name' => 'Ver sus datos',
            'slug' => 'users.show-me',
            'description' => 'Ver sus datos personales de usuario',
        ]);
        Permission::create([
            'id' => 245,
            'name' => 'Editar sus datos',
            'slug' => 'users.edit-me',
            'description' => 'Editar sus datos personales de usuario',
        ]);

        //Permissions
        Permission::create([
            'id' => 250,
            'name' => 'Listar permisos',
            'slug' => 'permissions.index',
            'description' => 'Listar y navegar todos los permisos',
        ]);
        Permission::create([
            'id' => 251,
            'name' => 'Ver permiso',
            'slug' => 'permissions.show',
            'description' => 'Ver informacion de un permiso especifico',
        ]);
        Permission::create([
            'id' => 252,
            'name' => 'Crear permiso',
            'slug' => 'permissions.create',
            'description' => 'Crear un nuevo permiso',
        ]);
        Permission::create([
            'id' => 253,
            'name' => 'Eliminar permiso',
            'slug' => 'permissions.destroy',
            'description' => 'Elimina un permiso y toda su informacion',
        ]);
        Permission::create([
            'id' => 254,
            'name' => 'Editar permiso',
            'slug' => 'permissions.edit',
            'description' => 'Editar la informacion de un permiso',
        ]);

        //Acceso A Menues
        Permission::create([
            'id' => 300,
            'name' => 'Menu Configuracion',
            'slug' => 'config.menu',
            'description' => 'Acceso al menu de configuracion',
        ]);
        Permission::create([
            'id' => 301,
            'name' => 'Menu Alertas',
            'slug' => 'alerts.menu',
            'description' => 'Acceso al menu de alertas',
        ]);
        Permission::create([
            'id' => 302,
            'name' => 'Menu Dispositivos',
            'slug' => 'devices.menu',
            'description' => 'Acceso al menu de dispositivos',
        ]);
        Permission::create([
            'id' => 303,
            'name' => 'Menu Pagos',
            'slug' => 'pays.menu',
            'description' => 'Acceso al menu de pagos',
        ]);
        Permission::create([
            'id' => 304,
            'name' => 'Panel Principal',
            'slug' => 'principal.menu',
            'description' => 'Acceso al panel principal',
        ]);

    }
}
