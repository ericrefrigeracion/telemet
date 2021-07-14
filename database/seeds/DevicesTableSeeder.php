<?php

use App\Device;
use Illuminate\Database\Seeder;

class DevicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Device::create([
            'id' => 123456,
            'type_device_id' => 4,
            'protection_id' => 1,
            'status_id' => 1,
            'icon_id' => 1,
            'name' => 'Equipo Full',
            'description' => 'Equipo conectado en casa',
            'admin_mon' => true,
            'protected' => true,
            'on_line' => false,
            'monitor_expires_at' => '2020-03-13 09:39:52',
            'view_alerts_at' => now(),
            'notification_email' => 'ericlopezrefrigeracion@gmail.com',
            'notification_phone_number' => '3385 - 470666'
        ]);

        DB::insert('insert into device_user (device_id, user_id) values (?, ?)', [123456, 1]);

        Device::create([
            'id' => 101366397,
            'type_device_id' => 2,
            'protection_id' => 1,
            'status_id' => 1,
            'icon_id' => 1,
            'name' => 'Camara Congelados',
            'description' => 'Galpon Savoy',
            'admin_mon' => false,
            'protected' => true,
            'on_line' => false,
            'monitor_expires_at' => '2020-03-13 09:39:52',
            'view_alerts_at' => now(),
            'notification_email' => 'savoyeventos@gmail.com',
            'notification_phone_number' => '3385 - 590495'
        ]);

        DB::insert('insert into device_user (device_id, user_id) values (?, ?)', [101366397, 3]);

        Device::create([
            'id' => 1011466246,
            'type_device_id' => 2,
            'protection_id' => 1,
            'status_id' => 1,
            'icon_id' => 1,
            'name' => 'Camara Congelados',
            'description' => 'Pescaderia Laboulaye',
            'admin_mon' => false,
            'protected' => true,
            'on_line' => false,
            'monitor_expires_at' => '2020-03-20 12:55:10',
            'view_alerts_at' => now(),
            'notification_email' => 'porcelmarcelo@gmail.com',
            'notification_phone_number' => '2364 - 676982'
        ]);

        DB::insert('insert into device_user (device_id, user_id) values (?, ?)', [1011466246, 5]);

        Device::create([
            'id' => 1011463103,
            'type_device_id' => 2,
            'protection_id' => 1,
            'status_id' => 1,
            'icon_id' => 1,
            'name' => 'Camara Masa',
            'description' => 'Temperatura Ambiente',
            'admin_mon' => true,
            'protected' => true,
            'on_line' => false,
            'monitor_expires_at' => '2021-05-30 07:09:40',
            'view_alerts_at' => now(),
            'notification_email' => 'albertobiancotti@hotmail.com',
            'notification_phone_number' => '3385 - 590644'
        ]);

        DB::insert('insert into device_user (device_id, user_id) values (?, ?)', [1011463103, 4]);

        Device::create([
            'id' => 101366579,
            'type_device_id' => 2,
            'protection_id' => 4,
            'status_id' => 1,
            'icon_id' => 1,
            'name' => 'Camara Quesos',
            'description' => 'Temperatura Ambiente',
            'admin_mon' => true,
            'protected' => false,
            'on_line' => false,
            'monitor_expires_at' => '2021-07-06 10:32:20',
            'view_alerts_at' => now(),
            'notification_email' => 'estebangiord@gmail.com',
            'notification_phone_number' => '3385 - 680537'
        ]);

        DB::insert('insert into device_user (device_id, user_id) values (?, ?)', [101366579, 8]);

        Device::create([
            'id' => 55218360,
            'type_device_id' => 2,
            'protection_id' => 1,
            'status_id' => 1,
            'icon_id' => 1,
            'name' => 'Freezer Horizontal',
            'description' => null,
            'admin_mon' => true,
            'protected' => true,
            'on_line' => false,
            'monitor_expires_at' => '2021-07-13 15:32:24',
            'view_alerts_at' => now(),
            'notification_email' => 'marcela_a_arrieta@yahoo.com.ar',
            'notification_phone_number' => '3385 - 406439'
        ]);

        DB::insert('insert into device_user (device_id, user_id) values (?, ?)', [55218360, 6]);

        Device::create([
            'id' => 55218361,
            'type_device_id' => 2,
            'protection_id' => 1,
            'status_id' => 1,
            'icon_id' => 1,
            'name' => 'Freezer Vertical',
            'description' => null,
            'admin_mon' => true,
            'protected' => true,
            'on_line' => false,
            'monitor_expires_at' => '2021-07-13 15:32:24',
            'view_alerts_at' => now(),
            'notification_email' => 'marcela_a_arrieta@yahoo.com.ar',
            'notification_phone_number' => '3385 - 406439'
        ]);

        DB::insert('insert into device_user (device_id, user_id) values (?, ?)', [55218361, 6]);

        Device::create([
            'id' => 55218362,
            'type_device_id' => 2,
            'protection_id' => 1,
            'status_id' => 1,
            'icon_id' => 1,
            'name' => 'Heladera 1',
            'description' => 'Exhibidora izquierda',
            'admin_mon' => true,
            'protected' => true,
            'on_line' => false,
            'monitor_expires_at' => '2021-07-13 15:32:24',
            'view_alerts_at' => now(),
            'notification_email' => 'marcela_a_arrieta@yahoo.com.ar',
            'notification_phone_number' => '3385 - 406439'
        ]);

        DB::insert('insert into device_user (device_id, user_id) values (?, ?)', [55218362, 6]);

        Device::create([
            'id' => 55218363,
            'type_device_id' => 2,
            'protection_id' => 1,
            'status_id' => 1,
            'icon_id' => 1,
            'name' => 'Heladera 2',
            'description' => 'Exhibidora derecha',
            'admin_mon' => true,
            'protected' => true,
            'on_line' => false,
            'monitor_expires_at' => '2021-07-13 15:32:24',
            'view_alerts_at' => now(),
            'notification_email' => 'marcela_a_arrieta@yahoo.com.ar',
            'notification_phone_number' => '3385 - 406439'
        ]);

        DB::insert('insert into device_user (device_id, user_id) values (?, ?)', [55218363, 6]);

        Device::create([
            'id' => 55218364,
            'type_device_id' => 2,
            'protection_id' => 1,
            'status_id' => 1,
            'icon_id' => 1,
            'name' => 'Heladera 3',
            'description' => 'Heladera con congelador',
            'admin_mon' => true,
            'protected' => true,
            'on_line' => false,
            'monitor_expires_at' => '2021-07-13 15:32:24',
            'view_alerts_at' => now(),
            'notification_email' => 'marcela_a_arrieta@yahoo.com.ar',
            'notification_phone_number' => '3385 - 406439'
        ]);

        DB::insert('insert into device_user (device_id, user_id) values (?, ?)', [55218364, 6]);

        Device::create([
            'id' => 114661760,
            'type_device_id' => 2,
            'protection_id' => 1,
            'status_id' => 1,
            'icon_id' => 1,
            'name' => 'Heladera 6',
            'description' => null,
            'admin_mon' => true,
            'protected' => true,
            'on_line' => false,
            'monitor_expires_at' => '2021-07-13 15:32:24',
            'view_alerts_at' => now(),
            'notification_email' => 'nestorrenaudo@yahoo.com.ar',
            'notification_phone_number' => '3385 - 437478'
        ]);

        DB::insert('insert into device_user (device_id, user_id) values (?, ?)', [114661760, 7]);

        Device::create([
            'id' => 114661761,
            'type_device_id' => 2,
            'protection_id' => 1,
            'status_id' => 1,
            'icon_id' => 1,
            'name' => 'Freezer 1',
            'description' => null,
            'admin_mon' => true,
            'protected' => true,
            'on_line' => false,
            'monitor_expires_at' => '2021-07-13 15:32:24',
            'view_alerts_at' => now(),
            'notification_email' => 'nestorrenaudo@yahoo.com.ar',
            'notification_phone_number' => '3385 - 437478'
        ]);

        DB::insert('insert into device_user (device_id, user_id) values (?, ?)', [114661761, 7]);

        Device::create([
            'id' => 114661762,
            'type_device_id' => 2,
            'protection_id' => 1,
            'status_id' => 1,
            'icon_id' => 1,
            'name' => 'Heladera 7',
            'description' => null,
            'admin_mon' => true,
            'protected' => true,
            'on_line' => false,
            'monitor_expires_at' => '2021-07-13 15:32:24',
            'view_alerts_at' => now(),
            'notification_email' => 'nestorrenaudo@yahoo.com.ar',
            'notification_phone_number' => '3385 - 437478'
        ]);

        DB::insert('insert into device_user (device_id, user_id) values (?, ?)', [114661762, 7]);

        Device::create([
            'id' => 114626870,
            'type_device_id' => 2,
            'protection_id' => 1,
            'status_id' => 1,
            'icon_id' => 1,
            'name' => 'Heladera 1',
            'description' => null,
            'admin_mon' => true,
            'protected' => true,
            'on_line' => false,
            'monitor_expires_at' => '2021-07-13 15:32:24',
            'view_alerts_at' => now(),
            'notification_email' => 'nestorrenaudo@yahoo.com.ar',
            'notification_phone_number' => '3385 - 437478'
        ]);

        DB::insert('insert into device_user (device_id, user_id) values (?, ?)', [114626870, 7]);

        Device::create([
            'id' => 114626871,
            'type_device_id' => 2,
            'protection_id' => 1,
            'status_id' => 1,
            'icon_id' => 1,
            'name' => 'Heladera 2',
            'description' => null,
            'admin_mon' => true,
            'protected' => true,
            'on_line' => false,
            'monitor_expires_at' => '2021-07-13 15:32:24',
            'view_alerts_at' => now(),
            'notification_email' => 'nestorrenaudo@yahoo.com.ar',
            'notification_phone_number' => '3385 - 437478'
        ]);

        DB::insert('insert into device_user (device_id, user_id) values (?, ?)', [114626871, 7]);

        Device::create([
            'id' => 114626872,
            'type_device_id' => 2,
            'protection_id' => 1,
            'status_id' => 1,
            'icon_id' => 1,
            'name' => 'Heladera 3',
            'description' => null,
            'admin_mon' => true,
            'protected' => true,
            'on_line' => false,
            'monitor_expires_at' => '2021-07-13 15:32:24',
            'view_alerts_at' => now(),
            'notification_email' => 'nestorrenaudo@yahoo.com.ar',
            'notification_phone_number' => '3385 - 437478'
        ]);

        DB::insert('insert into device_user (device_id, user_id) values (?, ?)', [114626872, 7]);

        Device::create([
            'id' => 114626873,
            'type_device_id' => 2,
            'protection_id' => 1,
            'status_id' => 1,
            'icon_id' => 1,
            'name' => 'Heladera 4',
            'description' => null,
            'admin_mon' => true,
            'protected' => true,
            'on_line' => false,
            'monitor_expires_at' => '2021-07-13 15:32:24',
            'view_alerts_at' => now(),
            'notification_email' => 'nestorrenaudo@yahoo.com.ar',
            'notification_phone_number' => '3385 - 437478'
        ]);

        DB::insert('insert into device_user (device_id, user_id) values (?, ?)', [114626873, 7]);

        Device::create([
            'id' => 114626874,
            'type_device_id' => 2,
            'protection_id' => 1,
            'status_id' => 1,
            'icon_id' => 1,
            'name' => 'Heladera 5',
            'description' => null,
            'admin_mon' => true,
            'protected' => true,
            'on_line' => false,
            'monitor_expires_at' => '2021-07-13 15:32:24',
            'view_alerts_at' => now(),
            'notification_email' => 'nestorrenaudo@yahoo.com.ar',
            'notification_phone_number' => '3385 - 437478'
        ]);

        DB::insert('insert into device_user (device_id, user_id) values (?, ?)', [114626874, 7]);

        Device::create([
            'id' => 1011462256,
            'type_device_id' => 2,
            'protection_id' => 1,
            'status_id' => 1,
            'icon_id' => 1,
            'name' => 'Tanque de Leche',
            'description' => null,
            'admin_mon' => true,
            'protected' => true,
            'on_line' => false,
            'monitor_expires_at' => '2021-07-13 15:32:24',
            'view_alerts_at' => now(),
            'notification_email' => 'ericlopezrefrigeracion@gmail.com',
            'notification_phone_number' => '3385 - 470666'
        ]);

        DB::insert('insert into device_user (device_id, user_id) values (?, ?)', [1011462256, 8]);

    }
}
