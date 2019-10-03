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
        	'type' => 'allways',
        	'description' => 'Siempre Protegido',
            'class' => 'far fa-check-square text-success m-2',
        ]);
        Protection::create([
        	'type' => 'comercial',
        	'description' => 'Protegido cuando cierro mi Comercio',
            'class' => 'fas fa-cash-register text-success m-2',
        ]);
        Protection::create([
        	'type' => 'rules',
        	'description' => 'Con horarios Permitidos (Perzonalizado)',
            'class' => 'far fa-clock text-success m-2',
        ]);
        Protection::create([
            'type' => 'never',
            'description' => 'Siempre Desprotegido (Monitoreo Deshabilitado)',
            'class' => 'fas fa-exclamation-circle text-danger m-2',
        ]);
    }
}
