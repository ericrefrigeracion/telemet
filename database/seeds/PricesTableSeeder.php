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
        	'description' => 'Monitoreo 30 dias',
        	'days' => 30,
            'installments' => 1,
            'excluded' => 'credit_card',
        ]);
        Price::create([
        	'price' => 38,
        	'description' => 'Monitoreo 60 dias',
        	'days' => 60,
            'installments' => 1,
            'excluded' => 'credit_card',
        ]);
        Price::create([
        	'price' => 170,
        	'description' => 'Monitoreo 360 dias',
        	'days' => 360,
            'installments' => 12,
            'excluded' => '',
        ]);
        Price::create([
        	'price' => 3,
        	'description' => 'Multiplicador',
        	'days' => 0,
            'installments' => 1,
            'excluded' => '',
        ]);
        Price::create([
            'price' => 30,
            'description' => 'Adquirir un nuevo equipo',
            'days' => 0,
            'installments' => 3,
            'excluded' => '',
        ]);

    }
}
