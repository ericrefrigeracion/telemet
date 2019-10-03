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
        	'name' => 'Listar dispositivos de un usuario',
        	'slug' => 'devices.index',
        	'description' => 'Listar y navegar todos sus dispositivos',
        ]);
        Permission::create([
            'name' => 'Todos los dispositivos de todos los usuarios',
            'slug' => 'devices.all',
            'description' => 'Listar y navegar todos los dispositivos existentes',
        ]);
        Permission::create([
        	'name' => 'Ver dispositivo',
        	'slug' => 'devices.show',
        	'description' => 'Ver informacion de un dispositivo especifico',
        ]);
        Permission::create([
            'name' => 'Ver log',
            'slug' => 'devices.log',
            'description' => 'Ver informacion log de un dispositivo especifico',
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
        	'name' => 'Editar dispositivo',
        	'slug' => 'devices.edit',
        	'description' => 'Editar la informacion de un dispositivo',
        ]);

        //Alerts
        Permission::create([
            'name' => 'Listar alertas de un usuario',
            'slug' => 'alerts.index',
            'description' => 'Ver todas las alertas de un usuario',
        ]);
        Permission::create([
            'name' => 'Listar alertas de un dispositivo',
            'slug' => 'alerts.show',
            'description' => 'Ver todas las alertas de un dispositivo',
        ]);
        Permission::create([
            'name' => 'Todas las alertas de todos los usuarios',
            'slug' => 'alerts.all',
            'description' => 'Listar y navegar todas las alertas ocurridas organizadas por dispositivo',
        ]);


        //Receptions
        Permission::create([
        	'name' => 'Ver ultima hora',
        	'slug' => 'receptions.show-hour',
        	'description' => 'Ver el grafico de la ultima hora de un dispositivo',
        ]);
        Permission::create([
            'name' => 'Ver ultimo dia',
            'slug' => 'receptions.show-day',
            'description' => 'Ver el grafico del ultimo dia de un dispositivo',
        ]);
        Permission::create([
            'name' => 'Ver ultima semana',
            'slug' => 'receptions.show-week',
            'description' => 'Ver el grafico de la ultima semana de un dispositivo',
        ]);
        Permission::create([
            'name' => 'Ver ultimo mes',
            'slug' => 'receptions.show-month',
            'description' => 'Ver el grafico delultimo mes de un dispositivo',
        ]);
        Permission::create([
            'name' => 'Todos los datos',
            'slug' => 'receptions.show-all',
            'description' => 'Ver el grafico de todos los datos de un dispositivo',
        ]);

        //Pays
        Permission::create([
            'name' => 'Ver sus pagos',
            'slug' => 'pays.index',
            'description' => 'Ver los pagos de un usuario',
        ]);
        Permission::create([
            'name' => 'Ver un pago',
            'slug' => 'pays.show',
            'description' => 'Ver un pago especifico de un usuario',
        ]);
        Permission::create([
            'name' => 'Pagar',
            'slug' => 'pays.create',
            'description' => 'Crear un pago para un dispositivo',
        ]);
        Permission::create([
            'name' => 'Todos los pagos',
            'slug' => 'pays.all',
            'description' => 'Ver todos los pagos de todos los usuarios',
        ]);

        //Rules
        Permission::create([
            'name' => 'Listar reglas',
            'slug' => 'rules.index',
            'description' => 'Listar y navegar todas las reglas',
        ]);
        Permission::create([
            'name' => 'Ver regla',
            'slug' => 'rules.show',
            'description' => 'Ver informacion de una regla especifica',
        ]);
        Permission::create([
            'name' => 'Crear regla',
            'slug' => 'rules.create',
            'description' => 'Crear una nueva regla',
        ]);
        Permission::create([
            'name' => 'Eliminar regla',
            'slug' => 'rules.destroy',
            'description' => 'Elimina una regla y toda su informacion',
        ]);
        Permission::create([
            'name' => 'Editar regla',
            'slug' => 'rules.edit',
            'description' => 'Editar la informacion de una regla',
        ]);
        Permission::create([
            'name' => 'Todas las Reglas',
            'slug' => 'rules.all',
            'description' => 'Ver todas las Reglas de todos los Dispositivos',
        ]);

        //Webhooks
        Permission::create([
            'name' => 'Ver WebHooks',
            'slug' => 'webhooks.index',
            'description' => 'Ver todos los webhooks de la plataforma',
        ]);
        Permission::create([
            'name' => 'Ver WebHook',
            'slug' => 'webhooks.show',
            'description' => 'Ver un webhook especifico',
        ]);

        //MailAlerts
        Permission::create([
            'name' => 'Listar MailAlerts',
            'slug' => 'mail-alerts.index',
            'description' => 'Ver todas las alertas por Email de la plataforma',
        ]);
        Permission::create([
            'name' => 'Ver MailAlerts',
            'slug' => 'mail-alerts.show',
            'description' => 'Ver una alerta por Email especifica',
        ]);

        //Prices
        Permission::create([
            'name' => 'Listar precios',
            'slug' => 'prices.index',
            'description' => 'Listar y navegar todos los precios',
        ]);
        Permission::create([
            'name' => 'Ver precio',
            'slug' => 'prices.show',
            'description' => 'Ver informacion de un precio especifico',
        ]);
        Permission::create([
            'name' => 'Crear precio',
            'slug' => 'prices.create',
            'description' => 'Crear un nuevo precio',
        ]);
        Permission::create([
            'name' => 'Eliminar precio',
            'slug' => 'prices.destroy',
            'description' => 'Elimina un precio y toda su informacion',
        ]);
        Permission::create([
            'name' => 'Editar precio',
            'slug' => 'prices.edit',
            'description' => 'Editar la informacion de un precio',
        ]);

        //Roles
        Permission::create([
            'name' => 'Listar roles',
            'slug' => 'roles.index',
            'description' => 'Listar y navegar todos los roles',
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
            'name' => 'Editar rol',
            'slug' => 'roles.edit',
            'description' => 'Editar la informacion de un rol',
        ]);

        //Users
        Permission::create([
            'name' => 'Listar usuarios',
            'slug' => 'users.index',
            'description' => 'Listar y navegar todos los usuarios',
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
            'name' => 'Editar usuario',
            'slug' => 'users.edit',
            'description' => 'Editar la informacion de un usuario',
        ]);
        Permission::create([
            'name' => 'Ver sus datos',
            'slug' => 'users.show-me',
            'description' => 'Ver sus datos personales de usuario',
        ]);
        Permission::create([
            'name' => 'Editar sus datos',
            'slug' => 'users.edit-me',
            'description' => 'Editar sus datos personales de usuario',
        ]);

        //Permissions
        Permission::create([
            'name' => 'Listar permisos',
            'slug' => 'permissions.index',
            'description' => 'Listar y navegar todos los permisos',
        ]);
        Permission::create([
            'name' => 'Ver permiso',
            'slug' => 'permissions.show',
            'description' => 'Ver informacion de un permiso especifico',
        ]);
        Permission::create([
            'name' => 'Crear permiso',
            'slug' => 'permissions.create',
            'description' => 'Crear un nuevo permiso',
        ]);
        Permission::create([
            'name' => 'Eliminar permiso',
            'slug' => 'permissions.destroy',
            'description' => 'Elimina un permiso y toda su informacion',
        ]);
        Permission::create([
            'name' => 'Editar permiso',
            'slug' => 'permissions.edit',
            'description' => 'Editar la informacion de un permiso',
        ]);

        //Acceso A Menues
        Permission::create([
            'name' => 'Menu Configuracion',
            'slug' => 'config.menu',
            'description' => 'Acceso al menu de configuracion',
        ]);
        Permission::create([
            'name' => 'Menu Alertas',
            'slug' => 'alerts.menu',
            'description' => 'Acceso al menu de alertas',
        ]);
        Permission::create([
            'name' => 'Menu Dispositivos',
            'slug' => 'devices.menu',
            'description' => 'Acceso al menu de dispositivos',
        ]);
        Permission::create([
            'name' => 'Menu Pagos',
            'slug' => 'pays.menu',
            'description' => 'Acceso al menu de pagos',
        ]);
        Permission::create([
            'name' => 'Panel Principal',
            'slug' => 'principal.menu',
            'description' => 'Acceso al panel principal',
        ]);

        //Protections
        Permission::create([
            'name' => 'Listar tipo proteccion',
            'slug' => 'protections.index',
            'description' => 'Listar y navegar todos los tipos de protecciones',
        ]);
        Permission::create([
            'name' => 'Ver proteccion',
            'slug' => 'protections.show',
            'description' => 'Ver informacion de una proteccion especifica',
        ]);
        Permission::create([
            'name' => 'Crear tipo proteccion',
            'slug' => 'protections.create',
            'description' => 'Crear un nuevo tipo de proteccion',
        ]);
        Permission::create([
            'name' => 'Eliminar tipo proteccion',
            'slug' => 'protections.destroy',
            'description' => 'Elimina un tipo de proteccion y toda su informacion',
        ]);
        Permission::create([
            'name' => 'Editar tipo proeccion',
            'slug' => 'protections.edit',
            'description' => 'Editar la informacion de un tipo de proteccion',
        ]);

        //Type-devices
        Permission::create([
            'name' => 'Listar tipo dispositivos',
            'slug' => 'type-devices.index',
            'description' => 'Listar y navegar todos los tipos de dispositivos',
        ]);
        Permission::create([
            'name' => 'Ver tipo dispositivo',
            'slug' => 'type-devices.show',
            'description' => 'Ver informacion de un tipo de dispositivo especifico',
        ]);
        Permission::create([
            'name' => 'Crear tipo dispositivo',
            'slug' => 'type-devices.create',
            'description' => 'Crear un nuevo tipo de dispositivo',
        ]);
        Permission::create([
            'name' => 'Eliminar tipo dispositivo',
            'slug' => 'type-devices.destroy',
            'description' => 'Elimina un tipo de dispositivo y toda su informacion',
        ]);
        Permission::create([
            'name' => 'Editar tipo dispositivo',
            'slug' => 'type-devices.edit',
            'description' => 'Editar la informacion de un tipo de dispositivo',
        ]);

    }
}
