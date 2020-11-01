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
        //vista para TiNY
    	Display::create([
            'name' => 'Linea temp1',
            'description' => 'Grafico de tipo lineas',
            'slug' => 'line',
            'title' => 'Temperatura Ambiente'
        ]);
        //vista para HEALTH
        Display::create([
            'name' => 'Linea temp1',
            'description' => 'Grafico de tipo lineas',
            'slug' => 'line',
            'title' => 'Canal 1'
        ]);
        Display::create([
            'name' => 'Linea temp2',
            'description' => 'Grafico de tipo lineas',
            'slug' => 'line',
            'title' => 'Canal 2'
        ]);
        Display::create([
            'name' => 'Linea temp3',
            'description' => 'Grafico de tipo lineas',
            'slug' => 'line',
            'title' => 'Canal 3'
        ]);
        Display::create([
            'name' => 'Linea temp4',
            'description' => 'Grafico de tipo lineas',
            'slug' => 'line',
            'title' => 'Canal 4'
        ]);
        Display::create([
            'name' => 'Linea temp5',
            'description' => 'Grafico de tipo lineas',
            'slug' => 'line',
            'title' => 'Canal 5'
        ]);

        Display::create([
            'name' => 'Estado',
            'description' => 'Indicador de estado tipo On/Off',
            'slug' => 'status',
            'title' => 'Estado'
        ]);
        Display::create([
            'name' => 'Aguja',
            'description' => 'Indicador de aguja',
            'slug' => 'gauge',
            'title' => 'Aguja'
        ]);
        Display::create([
            'name' => 'Barras',
            'description' => 'Grafico de tipo barras',
            'slug' => 'bars_chart',
            'title' => 'Barras'
        ]);

        //vista para Admin TINY
        Display::create([
            'name' => 'Line Perf Tiny',
            'description' => 'Grafico de performance para Tiny',
            'slug' => 'line',
            'title' => 'Performance',
        ]);
    }
}
