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
            'user_id' => 1,
            'type_device_id' => 2,
            'protection_id' => 1,
            'status_id' => 1,
            'icon_id' => 1,
            'name' => 'Equipo de Prueba',
            'description' => 'Equipo conectado en casa',
            'admin_mon' => true,
            'protected' => true,
            'on_line' => false,
            'monitor_expires_at' => now()->addDays(60),
            'view_alerts_at' => now(),
        ]);
    }
}
