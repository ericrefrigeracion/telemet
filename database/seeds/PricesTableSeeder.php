<?php

use App\Price;
use Illuminate\Database\Seeder;

class PricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Price::create([
        	'price' => 80,
            'type_device_id' => 1,
        	'description' => 'Multiplicador',
        	'days' => 0,
            'installments' => 1,
            'excluded' => '',
        ]);
        Price::create([
        	'price' => 10,
            'type_device_id' => 2,
        	'description' => 'Monitoreo 30 dias',
        	'days' => 30,
            'installments' => 1,
            'excluded' => '',
        ]);
        Price::create([
        	'price' => 22,
            'type_device_id' => 2,
        	'description' => 'Monitoreo 90 dias',
        	'days' => 90,
            'installments' => 1,
            'excluded' => '',
        ]);
        Price::create([
        	'price' => 66,
            'type_device_id' => 2,
        	'description' => 'Monitoreo 360 dias',
        	'days' => 360,
            'installments' => 3,
            'excluded' => '',
        ]);
        Price::create([
            'price' => 33,
            'type_device_id' => 3,
            'description' => 'Monitoreo 30 dias',
            'days' => 30,
            'installments' => 1,
            'excluded' => '',
        ]);
        Price::create([
            'price' => 56,
            'type_device_id' => 3,
            'description' => 'Monitoreo 60 dias',
            'days' => 60,
            'installments' => 1,
            'excluded' => '',
        ]);
        Price::create([
            'price' => 225,
            'type_device_id' => 3,
            'description' => 'Monitoreo 360 dias',
            'days' => 360,
            'installments' => 3,
            'excluded' => '',
        ]);
    }
}
