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
        //Profile
        Permission::create([
            'name' => 'Ver su perfil',
            'slug' => 'profile.show',
            'description' => 'Ver los datos de su perfil',
        ]);
        Permission::create([
            'name' => 'Editar su perfil',
            'slug' => 'profile.edit',
            'description' => 'Editar los datos de su perfil',
        ]);
        Permission::create([
            'name' => 'Eliminar perfil',
            'slug' => 'profile.destroy',
            'description' => 'Elimina su perfil',
        ]);

        //Alerts
        Permission::create([
            'name' => 'Listar alertas',
            'slug' => 'alerts.index',
            'description' => 'Ver todas las alertas de todos sus dispositivos',
        ]);
        Permission::create([
            'name' => 'Listar alertas de un dispositivo',
            'slug' => 'alerts.show',
            'description' => 'Ver todas las alertas de un dispositivo',
        ]);

        //Receptions
        Permission::create([
        	'name' => 'Ver graficos del dispositivo',
        	'slug' => 'data-receptions.show',
        	'description' => 'Ver el grafico de datos de un dispositivo',
        ]);

        //Device-logs
        Permission::create([
            'name' => 'Listar bitacoras',
            'slug' => 'device-logs.index',
            'description' => 'Listar y navegar todas las bitacoras de sus dispositivos',
        ]);
        Permission::create([
            'name' => 'Ver bitacora',
            'slug' => 'device-logs.show',
            'description' => 'Ver informacion de bitacora de un dispositivo',
        ]);
        Permission::create([
            'name' => 'Crear item en bitacora',
            'slug' => 'device-logs.create',
            'description' => 'Crear una nuevo item de la bitacora de un dispositivo',
        ]);
        Permission::create([
            'name' => 'Eliminar item',
            'slug' => 'device-logs.destroy',
            'description' => 'Elimina un item de la bitacora de un dispositivo',
        ]);
        Permission::create([
            'name' => 'Editar item',
            'slug' => 'device-logs.edit',
            'description' => 'Editar un item de la bitacora de un dispositivo',
        ]);

        //Pays
        Permission::create([
            'name' => 'Ver pagos',
            'slug' => 'pays.index',
            'description' => 'Ver los pagos de sus dispositivos',
        ]);
        Permission::create([
            'name' => 'Ver un pago',
            'slug' => 'pays.show',
            'description' => 'Ver un pago especifico',
        ]);
        Permission::create([
            'name' => 'Pagar',
            'slug' => 'pays.create',
            'description' => 'Crear un pago para un dispositivo',
        ]);

        //Rules
        Permission::create([
            'name' => 'Listar reglas',
            'slug' => 'rules.index',
            'description' => 'Listar y navegar todas las reglas de sus dispositivos',
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

        //Acceso a Graficos
        Permission::create([
            'name' => 'Vista grafico basico',
            'slug' => 'view.basic',
            'description' => 'Vista de graficos de un usuario basico',
        ]);
        Permission::create([
            'name' => 'Vista grafico medio',
            'slug' => 'view.med',
            'description' => 'Vista de usuario medio',
        ]);
        Permission::create([
            'name' => 'Vista grafico admin',
            'slug' => 'view.admin',
            'description' => 'Vista de usuario administrador',
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
            'name' => 'Editar dispositivo',
            'slug' => 'devices.edit',
            'description' => 'Editar la informacion de un dispositivo',
        ]);
        Permission::create([
            'name' => 'Configurar dispositivo',
            'slug' => 'devices.configuration',
            'description' => 'Ver y editar la configuracion de un dispositivos.',
        ]);

        //Acceso A Menues
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
        Permission::create([
            'name' => 'Menu Equipo de trabajo',
            'slug' => 'team.menu',
            'description' => 'Acceso al menu de equipo de trabajo',
        ]);
        Permission::create([
            'name' => 'Eliminar dispositivo',
            'slug' => 'devices.destroy',
            'description' => 'Elimina un dispositivo y toda su informacion',
        ]);
        Permission::create([
            'name' => 'Crear dispositivo',
            'slug' => 'devices.create',
            'description' => 'Crear un nuevo dispositivo',
        ]);

        //Users
        Permission::create([
            'name' => 'Listar equipo de trabajo',
            'slug' => 'users.index',
            'description' => 'Listar y navegar todos los miembros de un equipo',
        ]);
        Permission::create([
            'name' => 'Ver usuario',
            'slug' => 'users.show',
            'description' => 'Ver informacion de un usuario especifico',
        ]);
        Permission::create([
            'name' => 'Crear usuario',
            'slug' => 'users.create',
            'description' => 'Crear un usuario',
        ]);
        Permission::create([
            'name' => 'Eliminar usuario',
            'slug' => 'users.destroy',
            'description' => 'Eliminar el perfil de un usuario',
        ]);
        Permission::create([
            'name' => 'Editar usuario',
            'slug' => 'users.edit',
            'description' => 'Editar la informacion de un usuario y asignarle permisos',
        ]);

        //Admin ALL FUNCTIONS
        Permission::create([
            'name' => 'Menu Configuracion',
            'slug' => 'config.menu',
            'description' => 'Acceso al menu de configuracion',
        ]);
        Permission::create([
            'name' => 'Todos los vencimientos',
            'slug' => 'home.all',
            'description' => 'Ver el vencimiento de todos los dispositivos.',
        ]);
        Permission::create([
            'name' => 'Todas las Reglas',
            'slug' => 'rules.all',
            'description' => 'Ver todas las Reglas de todos los Dispositivos',
        ]);
        Permission::create([
            'name' => 'Todos los pagos',
            'slug' => 'pays.all',
            'description' => 'Ver todos los pagos de todos los usuarios',
        ]);
        Permission::create([
            'name' => 'Todas las alertas de todos los usuarios',
            'slug' => 'alerts.all',
            'description' => 'Listar y navegar todas las alertas ocurridas organizadas por dispositivo',
        ]);
        Permission::create([
            'name' => 'Todos los dispositivos de todos los usuarios',
            'slug' => 'devices.all',
            'description' => 'Listar y navegar todos los dispositivos existentes',
        ]);
        Permission::create([
            'name' => 'Todos los usuarios',
            'slug' => 'users.all',
            'description' => 'Ver todos losusuariosdel sistema.',
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
            'name' => 'Editar tipo proteccion',
            'slug' => 'protections.edit',
            'description' => 'Editar la informacion de un tipo de proteccion',
        ]);

        //Type-devices
        Permission::create([
            'name' => 'Listar tipos de dispositivos',
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
            'description' => 'Elimina un tipo de dispositivo y toda su configuracion',
        ]);
        Permission::create([
            'name' => 'Editar tipo dispositivo',
            'slug' => 'type-devices.edit',
            'description' => 'Editar la informacion de un tipo de dispositivo',
        ]);
        Permission::create([
            'name' => 'Configurar tipo dispositivo',
            'slug' => 'type-devices.configuration',
            'description' => 'Ver y editar la configuracion de un tipo o modelo de dispositivo.',
        ]);

        //Type Device Configuration
        Permission::create([
            'name' => 'Crear item de tipo de configuracion',
            'slug' => 'type-device-configurations.create',
            'description' => 'Crear un item de configuracion de un tipo o modelo de dispositivo.',
        ]);
        Permission::create([
            'name' => 'Eliminar item de tipo configuracion',
            'slug' => 'type-device-configurations.destroy',
            'description' => 'Eliminar un item de configuracion de un tipo o modelo de dispositivo.',
        ]);

        //Topic Control Types
        Permission::create([
            'name' => 'Listar topic controls',
            'slug' => 'topic-control-types.index',
            'description' => 'Listar y navegar todos los topic controls',
        ]);
        Permission::create([
            'name' => 'Ver topic control',
            'slug' => 'topic-control-types.show',
            'description' => 'Ver informacion de un topic control especifico',
        ]);
        Permission::create([
            'name' => 'Crear topic control',
            'slug' => 'topic-control-types.create',
            'description' => 'Crear un nuevo topic control',
        ]);
        Permission::create([
            'name' => 'Eliminar topic control',
            'slug' => 'topic-control-types.destroy',
            'description' => 'Elimina un topic control y toda su informacion',
        ]);
        Permission::create([
            'name' => 'Editar topic control',
            'slug' => 'topic-control-types.edit',
            'description' => 'Editar la informacion de un topic control',
        ]);

        //Topics
        Permission::create([
            'name' => 'Listar topico',
            'slug' => 'topics.index',
            'description' => 'Listar y navegar todos los topicos',
        ]);
        Permission::create([
            'name' => 'Ver topico',
            'slug' => 'topics.show',
            'description' => 'Ver informacion de un topico',
        ]);
        Permission::create([
            'name' => 'Crear topico',
            'slug' => 'topics.create',
            'description' => 'Crear un nuevo topico',
        ]);
        Permission::create([
            'name' => 'Eliminar topico',
            'slug' => 'topics.destroy',
            'description' => 'Elimina un topico y toda su informacion',
        ]);
        Permission::create([
            'name' => 'Editar topico',
            'slug' => 'topics.edit',
            'description' => 'Editar la informacion de un topico',
        ]);

        //Display
        Permission::create([
            'name' => 'Listar visualizador',
            'slug' => 'displays.index',
            'description' => 'Listar y navegar todos los visualizador',
        ]);
        Permission::create([
            'name' => 'Ver visualizador',
            'slug' => 'displays.show',
            'description' => 'Ver informacion de un visualizador',
        ]);
        Permission::create([
            'name' => 'Crear visualizador',
            'slug' => 'displays.create',
            'description' => 'Crear un nuevo visualizador',
        ]);
        Permission::create([
            'name' => 'Eliminar visualizador',
            'slug' => 'displays.destroy',
            'description' => 'Elimina un visualizador y toda su informacion',
        ]);
        Permission::create([
            'name' => 'Editar visualizador',
            'slug' => 'displays.edit',
            'description' => 'Editar la informacion de un visualizador',
        ]);

        //View configurations
        Permission::create([
            'name' => 'Listar configuracion de vista',
            'slug' => 'view-configurations.index',
            'description' => 'Listar y navegar todas las configuraciones de vistas',
        ]);
        Permission::create([
            'name' => 'Ver configuracion de vista',
            'slug' => 'view-configurations.show',
            'description' => 'Ver informacion de una configuracion',
        ]);
        Permission::create([
            'name' => 'Crear configuracion de vista',
            'slug' => 'view-configurations.create',
            'description' => 'Crear una nueva configuracion',
        ]);
        Permission::create([
            'name' => 'Eliminar configuracion de vista',
            'slug' => 'view-configurations.destroy',
            'description' => 'Elimina una configuracion de vista y toda su informacion',
        ]);
        Permission::create([
            'name' => 'Editar configuracion de vista',
            'slug' => 'view-configurations.edit',
            'description' => 'Editar la configuracion de una vista',
        ]);

        //Icons
        Permission::create([
            'name' => 'Listar iconos',
            'slug' => 'icons.index',
            'description' => 'Listar y navegar todos los iconos',
        ]);
        Permission::create([
            'name' => 'Ver icono',
            'slug' => 'icons.show',
            'description' => 'Ver informacion de un icono',
        ]);
        Permission::create([
            'name' => 'Crear icono',
            'slug' => 'icons.create',
            'description' => 'Crear un nuevo icono',
        ]);
        Permission::create([
            'name' => 'Eliminar icono',
            'slug' => 'icons.destroy',
            'description' => 'Elimina un icono y toda su informacion',
        ]);
        Permission::create([
            'name' => 'Editar icono',
            'slug' => 'icons.edit',
            'description' => 'Editar la informacion de un icono',
        ]);

        //Statuses
        Permission::create([
            'name' => 'Listar estados de funcionamiento',
            'slug' => 'statuses.index',
            'description' => 'Listar y navegar todos los estados de funcionamiento',
        ]);
        Permission::create([
            'name' => 'Ver estado de funcionamiento',
            'slug' => 'statuses.show',
            'description' => 'Ver informacion de un estado de funcionamiento',
        ]);
        Permission::create([
            'name' => 'Crear estado de funcionamiento',
            'slug' => 'statuses.create',
            'description' => 'Crear un nuevo estado de funcionamiento',
        ]);
        Permission::create([
            'name' => 'Eliminar estado de funcionamiento',
            'slug' => 'statuses.destroy',
            'description' => 'Elimina un estado de funcionamiento y toda su informacion',
        ]);
        Permission::create([
            'name' => 'Editar estado de funcionamiento',
            'slug' => 'statuses.edit',
            'description' => 'Editar la informacion de un estado de funcionamiento',
        ]);

        //Display-Topics
        Permission::create([
            'name' => 'Listar relaciones grafico-topico',
            'slug' => 'display-topics.index',
            'description' => 'Listar y navegar todos las relaciones grafico-topico',
        ]);
        Permission::create([
            'name' => 'Ver relacion grafico-topico',
            'slug' => 'display-topics.show',
            'description' => 'Ver informacion de una relacion grafico-topico',
        ]);
        Permission::create([
            'name' => 'Crear relacion grafico-topico',
            'slug' => 'display-topics.create',
            'description' => 'Crear un nuevo relacion grafico-topico',
        ]);
        Permission::create([
            'name' => 'Eliminar relacion grafico-topico',
            'slug' => 'display-topics.destroy',
            'description' => 'Elimina una relacion grafico-topico y toda su informacion',
        ]);
        Permission::create([
            'name' => 'Editar relacion grafico-topico',
            'slug' => 'display-topics.edit',
            'description' => 'Editar la relacion grafico-topico',
        ]);

        //Impersonate
        Permission::create([
            'name' => 'Iniciar sesion Como',
            'slug' => 'impersonate.start',
            'description' => 'Iniciar sesion como otro usuario',
        ]);

    }
}
