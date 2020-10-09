<?php

use App\Icon;
use Illuminate\Database\Seeder;

class IconsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Icon::create([
            'name' => 'Termometro',
            'description' => 'Termometro medio',
            'scripts' => '<i class="fas fa-thermometer-half"></i>',
            'type' => 'all'
        ]);
        Icon::create([
            'name' => 'Engranaje',
            'description' => 'Configuracion',
            'scripts' => '<i class="fas fa-cogs"></i>',
            'type' => 'display'
        ]);
        Icon::create([
            'name' => 'Graficos',
            'description' => 'Graficos',
            'scripts' => '<i class="fas fa-chart-line"></i>',
            'type' => 'display'
        ]);
        Icon::create([
            'name' => 'Campana',
            'description' => 'Alertas',
            'scripts' => '<i class="fas fa-bell"></i>',
            'type' => 'display'
        ]);
        Icon::create([
            'name' => 'Ojo',
            'description' => 'Protegido',
            'scripts' => '<i class="far fa-eye"></i>',
            'type' => 'protection'
        ]);
        Icon::create([
            'name' => 'Ojo no',
            'description' => 'Horario permitido',
            'scripts' => '<i class="far fa-eye-slash"></i>',
            'type' => 'protection'
        ]);
        Icon::create([
            'name' => 'Allways',
            'description' => 'Siempre protegido',
            'scripts' => '<i class="far fa-check-square text-success m-2"></i>',
            'type' => 'protection'
        ]);
        Icon::create([
            'name' => 'Commercial',
            'description' => 'Protegido en horario comercial',
            'scripts' => '<i class="fas fa-cash-register text-success m-2"></i>',
            'type' => 'protection'
        ]);
        Icon::create([
            'name' => 'Rules',
            'description' => 'Con horarios permitidos',
            'scripts' => '<i class="far fa-clock text-success m-2"></i>',
            'type' => 'protection'
        ]);
        Icon::create([
            'name' => 'Never',
            'description' => 'Monitoreo deshabilitado',
            'scripts' => '<i class="fas fa-exclamation-circle text-danger m-2"></i>',
            'type' => 'protection'
        ]);
        Icon::create([
            'name' => 'Normal',
            'description' => 'Tilde',
            'scripts' => '<i class="far fa-check-square"></i>',
            'type' => 'status'
        ]);
        Icon::create([
            'name' => 'Precaucion',
            'description' => 'Signo de exclamacion',
            'scripts' => '<i class="fas fa-exclamation"></i>',
            'type' => 'status'
        ]);
        Icon::create([
            'name' => 'Critico',
            'description' => 'Signo de exclamacion',
            'scripts' => '<i class="fas fa-exclamation-circle"></i>',
            'type' => 'status'
        ]);
    }
}
