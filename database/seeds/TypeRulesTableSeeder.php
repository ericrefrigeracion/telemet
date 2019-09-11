<?php

//
use App\TypeRule;
use Illuminate\Database\Seeder;

class TypeRulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeRule::create([
        	'type' => 'allways',
        	'description' => 'Siempre Protegido',
        ]);
        TypeRule::create([
        	'type' => 'comercial',
        	'description' => 'Protegido cuando cierro mi negocio',
        ]);
        TypeRule::create([
        	'type' => 'rules',
        	'description' => 'Horarios Permitidos(Personalizado)',
        ]);
    }
}
