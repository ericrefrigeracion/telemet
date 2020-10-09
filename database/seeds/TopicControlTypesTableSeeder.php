<?php

use App\TopicControlType;
use Illuminate\Database\Seeder;

class TopicControlTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TopicControlType::create([
            'slug' => 'tcal',
            'name' => 'Calibracion de Temperatura (°C)',
            'description' => 'calibracion de sensor',
            'operation' => '+',
            'min' => -10,
            'max' => 10,
            'step' => 0.01,
            'default' => 0,
        ]);
        TopicControlType::create([
            'slug' => 'min',
            'name' => 'Minima (°C)',
            'description' => 'topic menor que el valor de referencia',
            'operation' => '<',
            'min' => -40,
            'max' => 85,
            'step' => 0.01,
            'default' => 0,
        ]);
        TopicControlType::create([
            'slug' => 'max',
            'name' => 'Maxima (°C)',
            'description' => 'topic mayor que el valor de referencia',
            'operation' => '>',
            'min' => -40,
            'max' => 85,
            'step' => 0.01,
            'default' => 10,
        ]);
        TopicControlType::create([
            'slug' => 'perf',
            'name' => 'Performance (°C/h)',
            'description' => 'performance del topic',
            'operation' => '<',
            'min' => 0,
            'max' => 40,
            'step' => 0.1,
            'default' => 0,
        ]);
        TopicControlType::create([
            'slug' => 'dly',
            'name' => 'Retardo (Minutos)',
            'description' => 'retardo para reportar la falla',
            'operation' => '>',
            'min' => 0,
            'max' => 120,
            'step' => 1,
            'default' => 20,
        ]);
        TopicControlType::create([
            'slug' => 'acal',
            'name' => 'Calibracion de Amper (A)',
            'description' => 'calibracion de sensor',
            'operation' => '+',
            'min' => -10,
            'max' => 10,
            'step' => 0.01,
            'default' => 0,
        ]);
        TopicControlType::create([
            'slug' => 'vcal',
            'name' => 'Calibracion de Volts (V)',
            'description' => 'calibracion de sensor',
            'operation' => '+',
            'min' => -10,
            'max' => 10,
            'step' => 0.01,
            'default' => 0,
        ]);

    }
}
