<?php

use App\Device;
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
            'device_id' => 101366397,
            'topic_id' => 1,
            'topic_control_type_id' => 1,
            'value' => 0,
            'status_id' => 1,
        ]);
        DeviceConfiguration::create([
            'device_id' => 101366397,
            'topic_id' => 1,
            'topic_control_type_id' => 2,
            'value' => -21,
            'status_id' => 1,
        ]);
        DeviceConfiguration::create([
            'device_id' => 101366397,
            'topic_id' => 1,
            'topic_control_type_id' => 3,
            'value' => -10,
            'status_id' => 1,
        ]);
        DeviceConfiguration::create([
            'device_id' => 101366397,
            'topic_id' => 1,
            'topic_control_type_id' => 4,
            'value' => 0,
            'status_id' => 1,
        ]);
        DeviceConfiguration::create([
            'device_id' => 101366397,
            'topic_id' => 1,
            'topic_control_type_id' => 5,
            'value' => 30,
            'status_id' => 1,
        ]);

        DeviceConfiguration::create([
            'device_id' => 101366579,
            'topic_id' => 1,
            'topic_control_type_id' => 1,
            'value' => 0,
            'status_id' => 1,
        ]);
        DeviceConfiguration::create([
            'device_id' => 101366579,
            'topic_id' => 1,
            'topic_control_type_id' => 2,
            'value' => 0,
            'status_id' => 1,
        ]);
        DeviceConfiguration::create([
            'device_id' => 101366579,
            'topic_id' => 1,
            'topic_control_type_id' => 3,
            'value' => 10,
            'status_id' => 1,
        ]);
        DeviceConfiguration::create([
            'device_id' => 101366579,
            'topic_id' => 1,
            'topic_control_type_id' => 4,
            'value' => 0,
            'status_id' => 1,
        ]);
        DeviceConfiguration::create([
            'device_id' => 101366579,
            'topic_id' => 1,
            'topic_control_type_id' => 5,
            'value' => 30,
            'status_id' => 1,
        ]);

        DeviceConfiguration::create([
            'device_id' => 1011463103,
            'topic_id' => 1,
            'topic_control_type_id' => 1,
            'value' => 0.8,
            'status_id' => 1,
        ]);
        DeviceConfiguration::create([
            'device_id' => 1011463103,
            'topic_id' => 1,
            'topic_control_type_id' => 2,
            'value' => -2,
            'status_id' => 1,
        ]);
        DeviceConfiguration::create([
            'device_id' => 1011463103,
            'topic_id' => 1,
            'topic_control_type_id' => 3,
            'value' => 6,
            'status_id' => 1,
        ]);
        DeviceConfiguration::create([
            'device_id' => 1011463103,
            'topic_id' => 1,
            'topic_control_type_id' => 4,
            'value' => 0,
            'status_id' => 1,
        ]);
        DeviceConfiguration::create([
            'device_id' => 1011463103,
            'topic_id' => 1,
            'topic_control_type_id' => 5,
            'value' => 40,
            'status_id' => 1,
        ]);

        DeviceConfiguration::create([
            'device_id' => 1011466246,
            'topic_id' => 1,
            'topic_control_type_id' => 1,
            'value' => -2,
            'status_id' => 1,
        ]);
        DeviceConfiguration::create([
            'device_id' => 1011466246,
            'topic_id' => 1,
            'topic_control_type_id' => 2,
            'value' => -20,
            'status_id' => 1,
        ]);
        DeviceConfiguration::create([
            'device_id' => 1011466246,
            'topic_id' => 1,
            'topic_control_type_id' => 3,
            'value' => -2,
            'status_id' => 1,
        ]);
        DeviceConfiguration::create([
            'device_id' => 1011466246,
            'topic_id' => 1,
            'topic_control_type_id' => 4,
            'value' => 0,
            'status_id' => 1,
        ]);
        DeviceConfiguration::create([
            'device_id' => 1011466246,
            'topic_id' => 1,
            'topic_control_type_id' => 5,
            'value' => 30,
            'status_id' => 1,
        ]);

        for ($id=1; $id < 6; $id++)
        {
            DeviceConfiguration::create([
                'device_id' => 55218360,
                'topic_id' => 1,
                'topic_control_type_id' => $id,
                'value' => 0,
                'status_id' => 1,
            ]);
        }
        for ($id=1; $id < 6; $id++)
        {
            DeviceConfiguration::create([
                'device_id' => 55218361,
                'topic_id' => 1,
                'topic_control_type_id' => $id,
                'value' => 0,
                'status_id' => 1,
            ]);
        }
        for ($id=1; $id < 6; $id++)
        {
            DeviceConfiguration::create([
                'device_id' => 55218362,
                'topic_id' => 1,
                'topic_control_type_id' => $id,
                'value' => 0,
                'status_id' => 1,
            ]);
        }
        for ($id=1; $id < 6; $id++)
        {
            DeviceConfiguration::create([
                'device_id' => 55218363,
                'topic_id' => 1,
                'topic_control_type_id' => $id,
                'value' => 0,
                'status_id' => 1,
            ]);
        }
        for ($id=1; $id < 6; $id++)
        {
            DeviceConfiguration::create([
                'device_id' => 55218364,
                'topic_id' => 1,
                'topic_control_type_id' => $id,
                'value' => 0,
                'status_id' => 1,
            ]);
        }

        for ($id=1; $id < 6; $id++)
        {
            DeviceConfiguration::create([
                'device_id' => 114626870,
                'topic_id' => 1,
                'topic_control_type_id' => $id,
                'value' => 0,
                'status_id' => 1,
            ]);
        }
        for ($id=1; $id < 6; $id++)
        {
            DeviceConfiguration::create([
                'device_id' => 114626871,
                'topic_id' => 1,
                'topic_control_type_id' => $id,
                'value' => 0,
                'status_id' => 1,
            ]);
        }
        for ($id=1; $id < 6; $id++)
        {
            DeviceConfiguration::create([
                'device_id' => 114626872,
                'topic_id' => 1,
                'topic_control_type_id' => $id,
                'value' => 0,
                'status_id' => 1,
            ]);
        }
        for ($id=1; $id < 6; $id++)
        {
            DeviceConfiguration::create([
                'device_id' => 114626873,
                'topic_id' => 1,
                'topic_control_type_id' => $id,
                'value' => 0,
                'status_id' => 1,
            ]);
        }
        for ($id=1; $id < 6; $id++)
        {
            DeviceConfiguration::create([
                'device_id' => 114626874,
                'topic_id' => 1,
                'topic_control_type_id' => $id,
                'value' => 0,
                'status_id' => 1,
            ]);
        }

        for ($id=1; $id < 6; $id++)
        {
            DeviceConfiguration::create([
                'device_id' => 114661760,
                'topic_id' => 1,
                'topic_control_type_id' => $id,
                'value' => 0,
                'status_id' => 1,
            ]);
        }
        for ($id=1; $id < 6; $id++)
        {
            DeviceConfiguration::create([
                'device_id' => 114661761,
                'topic_id' => 1,
                'topic_control_type_id' => $id,
                'value' => 0,
                'status_id' => 1,
            ]);
        }
        for ($id=1; $id < 6; $id++)
        {
            DeviceConfiguration::create([
                'device_id' => 114661762,
                'topic_id' => 1,
                'topic_control_type_id' => $id,
                'value' => 0,
                'status_id' => 1,
            ]);
        }
        for ($id=1; $id < 6; $id++)
        {
            DeviceConfiguration::create([
                'device_id' => 123456,
                'topic_id' => 1,
                'topic_control_type_id' => $id,
                'value' => 0,
                'status_id' => 1,
            ]);
        }

    }
}
