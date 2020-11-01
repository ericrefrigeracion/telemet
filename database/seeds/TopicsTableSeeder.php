<?php

use App\Topic;
use Illuminate\Database\Seeder;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Topic::create([
            'slug' => 'temp1',
            'unit' => '°C',
            'name' => 'Temperatura',
            'decimals' => 2,
            'color' => 'rgba(0, 0, 255, 1)',
            'filled' => 'true',
        ]);
        Topic::create([
            'slug' => 'temp1',
            'unit' => '°C',
            'name' => 'Temperatura Canal 1',
            'decimals' => 2,
            'color' => 'rgba(0, 0, 255, 1)',
            'filled' => 'true',
        ]);
        Topic::create([
            'slug' => 'temp2',
            'unit' => '°C',
            'name' => 'Temperatura Canal 2',
            'decimals' => 2,
            'color' => 'rgba(0, 128, 255, 1)',
            'filled' => 'true',
        ]);
        Topic::create([
            'slug' => 'temp3',
            'unit' => '°C',
            'name' => 'Temperatura Canal 3',
            'decimals' => 2,
            'color' => 'rgba(90, 160, 255, 1)',
            'filled' => 'true',
        ]);
        Topic::create([
            'slug' => 'temp4',
            'unit' => '°C',
            'name' => 'Temperatura Canal 4',
            'decimals' => 2,
            'color' => 'rgba(103, 50, 255, 1)',
            'filled' => 'true',
        ]);
        Topic::create([
            'slug' => 'temp5',
            'unit' => '°C',
            'name' => 'Temperatura Canal 5',
            'decimals' => 2,
            'color' => 'rgba(170, 19, 255, 1)',
            'filled' => 'true',
        ]);
        Topic::create([
            'slug' => 'volt1',
            'unit' => 'V',
            'name' => 'Volts',
            'decimals' => 2,
            'color' => 'rgba(0, 0, 0, 1)',
            'filled' => 'true',
        ]);
        Topic::create([
            'slug' => 'volt2',
            'unit' => 'V',
            'name' => 'Volts',
            'decimals' => 2,
            'color' => 'rgba(0, 0, 0, 1)',
            'filled' => 'true',
        ]);
        Topic::create([
            'slug' => 'volt3',
            'unit' => 'V',
            'name' => 'Volts',
            'decimals' => 2,
            'color' => 'rgba(0, 0, 0, 1)',
            'filled' => 'true',
        ]);
        Topic::create([
            'slug' => 'Amp1',
            'unit' => 'A',
            'name' => 'Amperes',
            'decimals' => 2,
            'color' => 'rgba(0, 0, 0, 1)',
            'filled' => 'true',
        ]);
        Topic::create([
            'slug' => 'Amp2',
            'unit' => 'A',
            'name' => 'Amperes',
            'decimals' => 2,
            'color' => 'rgba(0, 0, 0, 1)',
            'filled' => 'true',
        ]);
        Topic::create([
            'slug' => 'Amp3',
            'unit' => 'A',
            'name' => 'Amperes',
            'decimals' => 2,
            'color' => 'rgba(0, 0, 0, 1)',
            'filled' => 'true',
        ]);
        Topic::create([
            'slug' => 'signal',
            'unit' => '%',
            'name' => 'Señal',
            'decimals' => 2,
            'color' => 'rgba(0, 0, 0, 1)',
            'filled' => 'true',
        ]);
        Topic::create([
            'slug' => 'batt',
            'unit' => 'V',
            'name' => 'Bateria',
            'decimals' => 2,
            'color' => 'rgba(0, 0, 0, 1)',
            'filled' => 'true',
        ]);
        Topic::create([
            'slug' => 'output1',
            'unit' => '',
            'name' => 'Estado',
            'decimals' => 0,
            'color' => 'rgba(0, 0, 0, 1)',
            'filled' => 'true',
        ]);
        Topic::create([
            'slug' => 'output2',
            'unit' => '',
            'name' => 'Estado',
            'decimals' => 0,
            'color' => 'rgba(0, 0, 0, 1)',
            'filled' => 'true',
        ]);
        Topic::create([
            'slug' => 'temp1_derivate',
            'unit' => '°C',
            'name' => 'Derivada',
            'decimals' => 2,
            'color' => 'rgba(0, 0, 255, 1)',
            'filled' => 'true',
        ]);
        Topic::create([
            'slug' => 'temp1_performance',
            'unit' => '°C/h',
            'name' => 'Performance',
            'decimals' => 2,
            'color' => 'rgba(0, 128, 255, 1)',
            'filled' => 'true',
        ]);
    }
}
