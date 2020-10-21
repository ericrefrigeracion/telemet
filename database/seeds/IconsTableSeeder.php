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
            'scripts' => 'fas fa-thermometer-half',
            'type' => 'all'
        ]);
        Icon::create([
            'name' => 'Engranaje',
            'description' => 'Configuracion',
            'scripts' => 'fas fa-cogs',
            'type' => 'display'
        ]);
        Icon::create([
            'name' => 'Graficos',
            'description' => 'Graficos',
            'scripts' => 'fas fa-chart-line',
            'type' => 'display'
        ]);
        Icon::create([
            'name' => 'Campana',
            'description' => 'Alertas',
            'scripts' => 'fas fa-bell',
            'type' => 'display'
        ]);
        Icon::create([
            'name' => 'Ojo',
            'description' => 'Protegido',
            'scripts' => 'far fa-eye',
            'type' => 'protection'
        ]);
        Icon::create([
            'name' => 'Ojo no',
            'description' => 'Horario permitido',
            'scripts' => 'far fa-eye-slash',
            'type' => 'protection'
        ]);
        Icon::create([
            'name' => 'Allways',
            'description' => 'Siempre protegido',
            'scripts' => 'far fa-check-square text-success m-2',
            'type' => 'protection'
        ]);
        Icon::create([
            'name' => 'Commercial',
            'description' => 'Protegido en horario comercial',
            'scripts' => 'fas fa-cash-register text-success m-2',
            'type' => 'protection'
        ]);
        Icon::create([
            'name' => 'Rules',
            'description' => 'Con horarios permitidos',
            'scripts' => 'far fa-clock text-success m-2',
            'type' => 'protection'
        ]);
        Icon::create([
            'name' => 'Never',
            'description' => 'Monitoreo deshabilitado',
            'scripts' => 'fas fa-exclamation-circle text-danger m-2',
            'type' => 'protection'
        ]);
        Icon::create([
            'name' => 'Normal',
            'description' => 'Tilde',
            'scripts' => 'far fa-check-square',
            'type' => 'status'
        ]);
        Icon::create([
            'name' => 'Precaucion',
            'description' => 'Signo de exclamacion',
            'scripts' => 'fas fa-exclamation',
            'type' => 'status'
        ]);
        Icon::create([
            'name' => 'Critico',
            'description' => 'Signo de exclamacion',
            'scripts' => 'fas fa-exclamation-circle',
            'type' => 'status'
        ]);
    }
}
