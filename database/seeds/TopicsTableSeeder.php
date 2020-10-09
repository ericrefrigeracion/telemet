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
        ]);
        Topic::create([
            'slug' => 'temp2',
            'unit' => '°C',
            'name' => 'Temperatura',
            'decimals' => 2,
        ]);
        Topic::create([
            'slug' => 'temp3',
            'unit' => '°C',
            'name' => 'Temperatura',
            'decimals' => 2,
        ]);
        Topic::create([
            'slug' => 'temp4',
            'unit' => '°C',
            'name' => 'Temperatura',
            'decimals' => 2,
        ]);
        Topic::create([
            'slug' => 'temp5',
            'unit' => '°C',
            'name' => 'Temperatura',
            'decimals' => 2,
        ]);
        Topic::create([
            'slug' => 'temp6',
            'unit' => '°C',
            'name' => 'Temperatura',
            'decimals' => 2,
        ]);
        Topic::create([
            'slug' => 'volt1',
            'unit' => 'V',
            'name' => 'Volts',
            'decimals' => 2,
        ]);
        Topic::create([
            'slug' => 'volt2',
            'unit' => 'V',
            'name' => 'Volts',
            'decimals' => 2,
        ]);
        Topic::create([
            'slug' => 'volt3',
            'unit' => 'V',
            'name' => 'Volts',
            'decimals' => 2,
        ]);
        Topic::create([
            'slug' => 'Amp1',
            'unit' => 'A',
            'name' => 'Amperes',
            'decimals' => 2,
        ]);
        Topic::create([
            'slug' => 'Amp2',
            'unit' => 'A',
            'name' => 'Amperes',
            'decimals' => 2,
        ]);
        Topic::create([
            'slug' => 'Amp3',
            'unit' => 'A',
            'name' => 'Amperes',
            'decimals' => 2,
        ]);
        Topic::create([
            'slug' => 'signal',
            'unit' => '%',
            'name' => 'Señal',
            'decimals' => 2,
        ]);
        Topic::create([
            'slug' => 'batt',
            'unit' => 'V',
            'name' => 'Bateria',
            'decimals' => 2,
        ]);
        Topic::create([
            'slug' => 'output1',
            'unit' => '',
            'name' => 'Estado',
            'decimals' => 0,
        ]);
        Topic::create([
            'slug' => 'output2',
            'unit' => '',
            'name' => 'Estado',
            'decimals' => 0,
        ]);
    }
}
