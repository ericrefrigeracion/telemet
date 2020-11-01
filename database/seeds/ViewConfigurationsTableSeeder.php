<?php

use App\ViewConfiguration;
use Illuminate\Database\Seeder;

class ViewConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //vista tiny
        ViewConfiguration::create([
            'type_device_id' => 2,
            'display_id' => 1,
            'order' => 1,
            'permission' => 'view.basic'
        ]);
        //vista health
        ViewConfiguration::create([
            'type_device_id' => 3,
            'display_id' => 2,
            'order' => 1,
            'permission' => 'view.basic'
        ]);
        ViewConfiguration::create([
            'type_device_id' => 3,
            'display_id' => 3,
            'order' => 2,
            'permission' => 'view.basic'
        ]);
        ViewConfiguration::create([
            'type_device_id' => 3,
            'display_id' => 4,
            'order' => 3,
            'permission' => 'view.basic'
        ]);
        ViewConfiguration::create([
            'type_device_id' => 3,
            'display_id' => 5,
            'order' => 4,
            'permission' => 'view.basic'
        ]);
        ViewConfiguration::create([
            'type_device_id' => 3,
            'display_id' => 6,
            'order' => 5,
            'permission' => 'view.basic'
        ]);
    }
}
