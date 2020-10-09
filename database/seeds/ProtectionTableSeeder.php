<?php

use App\Protection;
use Illuminate\Database\Seeder;

class ProtectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Protection::create([
            'icon_id' => 7,
        	'type' => 'allways',
        	'description' => 'Siempre Protegido',
        ]);
        Protection::create([
            'icon_id' => 8,
        	'type' => 'comercial',
        	'description' => 'Protegido cuando cierro mi Comercio',
        ]);
        Protection::create([
            'icon_id' => 9,
        	'type' => 'rules',
        	'description' => 'Con horarios Permitidos (Perzonalizado)',
        ]);
        Protection::create([
            'icon_id' => 10,
            'type' => 'never',
            'description' => 'Siempre Desprotegido (Monitoreo Deshabilitado)',
        ]);
    }
}
