<?php

use App\Device;
use Illuminate\Database\Seeder;

class DeviceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Device::create([
        	'name' => 'Dispositivo de Prueba',
        	'description' => 'Mediciones de temperatura en tiempo real',
        	'id' => 1234,
			'user_id' => 3,
			'view_alerts_at' => now(),
			'mdl' => 't',
			'tmon' => 0,
			'tmin' => 0,
			'tmax' => 0,
			'tdly' => 0,
			'tcal' => 0,
			'hmon' => 0,
			'hmin' => 0,
			'hmax' => 0,
			'hdly' => 0,
			'hcal' => 0,
        ]);
    }
}
