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
            'prefix' => 0,
            'model' => 'Dispositivo Administrativo',
            'description' => 'NO BORRAR',
        ]);
        TypeDevice::create([
            'prefix' => 10,
            'model' => 'Tiny',
            'description' => 'Una medicion de temperatura ambiente.',
        ]);
        TypeDevice::create([
            'prefix' => 20,
            'model' => 'Dairy',
            'description' => 'Monitoreo de equipos de frio para tambos.',
        ]);
    }
}
