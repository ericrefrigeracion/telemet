<?php

use App\TypeDeviceConfiguration;
use Illuminate\Database\Seeder;

class TypeDeviceConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeDeviceConfiguration::create([
            'type_device_id' => 2,
            'topic_id' => 1,
            'topic_control_type_id' => 1,
        ]);
        TypeDeviceConfiguration::create([
            'type_device_id' => 2,
            'topic_id' => 1,
            'topic_control_type_id' => 2,
        ]);
        TypeDeviceConfiguration::create([
            'type_device_id' => 2,
            'topic_id' => 1,
            'topic_control_type_id' => 3,
        ]);
        TypeDeviceConfiguration::create([
            'type_device_id' => 2,
            'topic_id' => 1,
            'topic_control_type_id' => 4,
        ]);
        TypeDeviceConfiguration::create([
            'type_device_id' => 2,
            'topic_id' => 1,
            'topic_control_type_id' => 5,
        ]);
    }
}
