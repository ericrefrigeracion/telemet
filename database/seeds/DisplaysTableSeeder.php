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
            'slug' => 'line_chart',
            'scripts' => ''
        ]);
        Display::create([
            'name' => 'Estado',
            'description' => 'Indicador de estado tipo On/Off',
            'slug' => 'status',
            'scripts' => ''
        ]);
        Display::create([
            'name' => 'Aguja',
            'description' => 'Indicador de aguja',
            'slug' => 'gauge',
            'scripts' => ''
        ]);
        Display::create([
            'name' => 'Barras',
            'description' => 'Grafico de tipo barras',
            'slug' => 'bars_chart',
            'scripts' => ''
        ]);
    }
}
