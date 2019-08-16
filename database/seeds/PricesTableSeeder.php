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
        	'price' => 2,
            'device_mdl' => 't',
        	'description' => 'Monitoreo 30 dias',
        	'days' => 30,
            'installments' => 1,
            'excluded' => '',
        ]);
        Price::create([
        	'price' => 38,
            'device_mdl' => 't',
        	'description' => 'Monitoreo 60 dias',
        	'days' => 60,
            'installments' => 1,
            'excluded' => '',
        ]);
        Price::create([
        	'price' => 170,
            'device_mdl' => 't',
        	'description' => 'Monitoreo 360 dias',
        	'days' => 360,
            'installments' => 3,
            'excluded' => '',
        ]);
        Price::create([
        	'price' => 3,
            'device_mdl' => 'admin',
        	'description' => 'Multiplicador',
        	'days' => 0,
            'installments' => 1,
            'excluded' => '',
        ]);
    }
}
