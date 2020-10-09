<?php

use App\Status;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'name' => 'Normal',
            'description' => 'Condiciones de funcionamiento normal',
            'icon_id' => 11,
            'scripts' => ''
        ]);
        Status::create([
            'name' => 'Precaucion',
            'description' => 'Condiciones de funcionamiento anormal',
            'icon_id' => 12,
            'scripts' => ''
        ]);
        Status::create([
            'name' => 'Critico',
            'description' => 'Condiciones de funcionamiento critico',
            'icon_id' => 13,
            'scripts' => ''
        ]);
    }
}
