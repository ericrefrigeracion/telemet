<?php

use App\TypeDevice;
use Illuminate\Database\Seeder;

class TypeDevicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeDevice::create([
            'icon_id' => 14,
            'prefix' => 0,
            'model' => 'Dispositivo Administrativo',
            'description' => 'NO BORRAR',
        ]);
        TypeDevice::create([
            'icon_id' => 15,
            'prefix' => 10,
            'model' => 'Tiny',
            'description' => 'Una medicion de temperatura ambiente.',
        ]);
        TypeDevice::create([
            'icon_id' => 16,
            'prefix' => 20,
            'model' => 'Dairy',
            'description' => 'Monitoreo de equipos de frio para tambos.',
        ]);
    }
}
