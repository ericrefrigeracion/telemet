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

        //Tiny Configuration
        for ($topic_control_type_id=1; $topic_control_type_id < 6; $topic_control_type_id++)
            {
                TypeDeviceConfiguration::create([
                    'type_device_id' => 2,
                    'topic_id' => 1,
                    'topic_control_type_id' => $topic_control_type_id,
                ]);
            }

        //Health Configuration
        for ($topic_id=2; $topic_id < 7; $topic_id++)
        {
            for ($topic_control_type_id=1; $topic_control_type_id < 6; $topic_control_type_id++)
            {
                TypeDeviceConfiguration::create([
                    'type_device_id' => 3,
                    'topic_id' => $topic_id,
                    'topic_control_type_id' => $topic_control_type_id,
                ]);
            }
        }

    }
}
