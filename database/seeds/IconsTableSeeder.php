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
        //Device
        Icon::create([
            'name' => 'Termometro',
            'description' => 'Termometro medio',
            'scripts' => 'fas fa-thermometer-half',
            'type' => 'device'
        ]);

        //Display
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

        //Protection
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

        //Status
        Icon::create([
            'name' => 'Normal',
            'description' => 'Tilde',
            'scripts' => 'far fa-check-square text-success',
            'type' => 'status'
        ]);
        Icon::create([
            'name' => 'Precaucion',
            'description' => 'Signo de exclamacion',
            'scripts' => 'fas fa-exclamation text-warning',
            'type' => 'status'
        ]);
        Icon::create([
            'name' => 'Critico',
            'description' => 'Signo de exclamacion',
            'scripts' => 'fas fa-exclamation-circle text-danger',
            'type' => 'status'
        ]);

        //Type-Device
        Icon::create([
            'name' => 'Admin',
            'description' => 'Usuario engranaje',
            'scripts' => 'fas fa-user-cog',
            'type' => 'type-device'
        ]);
        Icon::create([
            'name' => 'Tiny',
            'description' => 'Avion de papel',
            'scripts' => 'far fa-paper-plane',
            'type' => 'type-device'
        ]);
        Icon::create([
            'name' => 'Dairy',
            'description' => 'Mano y gota',
            'scripts' => 'fas fa-hand-holding-water',
            'type' => 'type-device'
        ]);

        //Topics
        Icon::create([
            'name' => 'Temperatura',
            'description' => 'Termometro medio',
            'scripts' => 'fas fa-thermometer-half',
            'type' => 'topic'
        ]);
        Icon::create([
            'name' => 'Termometro min',
            'description' => 'Termometro bajo',
            'scripts' => 'fas fa-temperature-low',
            'type' => 'topic'
        ]);
        Icon::create([
            'name' => 'Termometro max',
            'description' => 'Termometro alto',
            'scripts' => 'fas fa-temperature-high',
            'type' => 'topic'
        ]);
        Icon::create([
            'name' => 'Señal',
            'description' => 'Nivel de señal lleno',
            'scripts' => 'fas fa-signal',
            'type' => 'topic'
        ]);
        Icon::create([
            'name' => 'Bateria',
            'description' => 'Bateria 3/4',
            'scripts' => 'fas fa-battery-three-quarters',
            'type' => 'topic'
        ]);
        Icon::create([
            'name' => 'Performance',
            'description' => 'Onda cuadrada',
            'scripts' => 'fas fa-wave-square',
            'type' => 'topic'
        ]);
        Icon::create([
            'name' => 'Calibracion',
            'description' => 'Doble flecha vertical',
            'scripts' => 'fas fa-arrows-alt-v',
            'type' => 'topic'
        ]);
        Icon::create([
            'name' => 'Consumo',
            'description' => 'Enchufe',
            'scripts' => 'fas fa-plug',
            'type' => 'topic'
        ]);

    }
}
