<?php

namespace App\Jobs\Rule;

use App\Rule;
use App\Device;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RuleProtectedDeviceRevissionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $device;
    public $tries = 5;
    public $timeout = 30;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Device $device)
    {
        $this->device = $device;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $device = $this->device;
        $day = now()->dayOfWeek;
        switch ($day) {
            case 0:
                $rules = Rule::where('device_id', $device->id)->where('day', 'Domingo')->get();
                break;
            case 1:
                $rules = Rule::where('device_id', $device->id)->where('day', 'Lunes')->orWhere('day', 'Lunes a Viernes')->get();
                break;
            case 2:
                $rules = Rule::where('device_id', $device->id)->where('day', 'Martes')->orWhere('day', 'Lunes a Viernes')->get();
                break;
            case 3:
                $rules = Rule::where('device_id', $device->id)->where('day', 'Miercoles')->orWhere('day', 'Lunes a Viernes')->get();
                break;
            case 4:
                $rules = Rule::where('device_id', $device->id)->where('day', 'Jueves')->orWhere('day', 'Lunes a Viernes')->get();
                break;
            case 5:
                $rules = Rule::where('device_id', $device->id)->where('day', 'Viernes')->orWhere('day', 'Lunes a Viernes')->get();
                break;
            case 6:
                $rules = Rule::where('device_id', $device->id)->where('day', 'Sabado')->get();
                break;

            default:
                # code...
                break;
        }
        foreach ($rules as $rule)
        {

        }
    }
}
