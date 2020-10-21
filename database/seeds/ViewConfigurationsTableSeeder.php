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
        ViewConfiguration::create([
            'type_device_id' => 2,
            'display_id' => 1,
            'order' => 1,
            'permission' => 'view.admin'
        ]);
    }
}
