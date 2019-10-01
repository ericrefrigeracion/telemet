<?php

//
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
			'model' => 'Admin',
			'description' => 'Administrador'
    	]);
    	TypeDevice::create([
    		'prefix' => 10,
			'model' => 'Centinela Tiny t',
			'description' => 'Una temperatura',
			'data01_unit' => '°C',
			'data01_name' => 'Temperatura',
    	]);
    	TypeDevice::create([
    		'prefix' => 20,
			'model' => 'Centinela Tiny th',
			'description' => 'Una temperatura, una Humedad',
			'data01_unit' => '°C',
			'data01_name' => 'Temperatura',
			'data02_unit' => '%',
			'data02_name' => 'Humedad',
    	]);
    	TypeDevice::create([
    		'prefix' => 90,
			'model' => 'Centinela tta',
			'description' => 'Dos temperaturas, una Humedad',
			'data01_unit' => '°C',
			'data01_name' => 'Temperatura',
			'data02_unit' => '°C',
			'data02_name' => 'Temperatura',
			'data03_unit' => 'A',
			'data03_name' => 'Consumo',
    	]);
    }
}
