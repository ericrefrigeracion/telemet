<?php

use App\Display;
use Illuminate\Database\Seeder;

class DisplaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Display::create([
            'name' => 'Linea',
            'description' => 'Grafico de tipo lineas',
            'slug' => 'line',
        ]);
        Display::create([
            'name' => 'Estado',
            'description' => 'Indicador de estado tipo On/Off',
            'slug' => 'status',
        ]);
        Display::create([
            'name' => 'Aguja',
            'description' => 'Indicador de aguja',
            'slug' => 'gauge',
        ]);
        Display::create([
            'name' => 'Barras',
            'description' => 'Grafico de tipo barras',
            'slug' => 'bars_chart',
        ]);
    }
}
