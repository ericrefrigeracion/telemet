<?php

use App\DeviceConfiguration;
use Illuminate\Database\Seeder;

class DeviceConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeviceConfiguration::create([
            'device_id' => 123456,
            'topic_id' => 1,
            'topic_control_type_id' => 1,
            'value' => 0,
            'status_id' => 1,
        ]);
        DeviceConfiguration::create([
            'device_id' => 123456,
            'topic_id' => 1,
            'topic_control_type_id' => 2,
            'value' => 0,
            'status_id' => 1,
        ]);
        DeviceConfiguration::create([
            'device_id' => 123456,
            'topic_id' => 1,
            'topic_control_type_id' => 3,
            'value' => 10,
            'status_id' => 1,
        ]);
        DeviceConfiguration::create([
            'device_id' => 123456,
            'topic_id' => 1,
            'topic_control_type_id' => 4,
            'value' => 0,
            'status_id' => 1,
        ]);
        DeviceConfiguration::create([
            'device_id' => 123456,
            'topic_id' => 1,
            'topic_control_type_id' => 5,
            'value' => 20,
            'status_id' => 1,
        ]);
    }
}
