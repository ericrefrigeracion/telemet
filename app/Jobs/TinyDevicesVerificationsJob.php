<?php

namespace App\Jobs;

use App\Device;
use App\MailAlert;
use App\DataReception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TinyDevicesVerificationsJob implements ShouldQueue
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
        $devices = Device::where('admin_mon', true)->where('on_line', true)->where('protected', true)->where('type_device_id', 2)->get();
        if($devices->isNotEmpty()) $this->allVerifications($devices);
    }

    public function allVerifications($devices)
    {

        $performance_time = now()->subHours(3);

        foreach ($devices as $device)
        {
            $device_configurations = $device->device_configurationsurations()->get();

            $this->analisys($device, $performance_time);

        }
    }

    public function analisys($device, $performance_time)
    {
        $this->derivate($device);
        $this->performance($device, $performance_time);
    }

    public function derivate($device)
    {
        $last_reception = $device->data_receptions()->where('topic', 'temp1')->where('status', null)->latest()->first();
        $before_reception = $device->data_receptions()->where('topic', 'temp1')->where('status', 'tested')->latest()->first();

        if($last_reception->isNotEmpty())
        {
            if($before_reception->isEmpty()) $before_reception->value = $last_reception->value;
            $derivate = $before_reception->value - $last_reception->value;
            if($derivate > 10) $derivate = 10;
            if($derivate < -10) $derivate = -10;

            DataReception::create([
                'device_id' => $device->id,
                'topic' => 'derivate',
                'value' => $derivate,
                'status' => null,
            ]);
            $last_reception->update(['status' => 'tested']);
        }

    }

    public function performance($device, $performance_time)
    {

        $performance = $device->data_receptions()->where('created_at', '>', $performance_time)->where('topic', 'derivate')->sum('value');
        if($performance > 40) $performance = 40;
        if($performance < 0) $performance = 0;

        DataReception::create([
            'device_id' => $device->id,
            'topic' => 'performance',
            'value' => $performance,
            'status' => null,
        ]);

    }


}
