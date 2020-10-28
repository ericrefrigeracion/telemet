<?php

namespace App\Jobs;

use App\Device;
use App\DataReception;
use Illuminate\Bus\Queueable;
use App\TypeDeviceConfiguration;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DevicesTopicControlsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;
    public $timeout = 30;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $devices = Device::where('protected', true)->where('admin_mon', true)->where('on_line', true)->get();
        if($devices->isNotEmpty()) $this->topicControl($devices);
    }

    public function topicControl($devices)
    {
        $type_device_configurations = TypeDeviceConfiguration::all();
        $data_receptions = DataReception::where('created_at', '>', now()->subMinutes(5))->get();

        foreach ($devices as $device)
        {
            $type_device_configurations->where('type_device_id', $device->type_device_id);

            foreach ($type_device_configurations as $type_device_configuration)
            {
                echo $data_receptions->where('topic', $type_device_configuration->topic->slug)->latest()->first()->value . ' - ';
                echo $type_device_configuration->topic_control_type->name . '. ';
            }
        }
    }


}
