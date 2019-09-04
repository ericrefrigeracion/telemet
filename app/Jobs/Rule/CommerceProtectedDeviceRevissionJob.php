<?php

namespace App\Jobs\Rule;

use App\Device;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CommerceProtectedDeviceRevissionJob implements ShouldQueue
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
        $time = now()->toTimeString();
        $device_protected_flag = true;

        switch ($day) {
            case 0:
                break;
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
                if($time > '8:00:00' && $time < '12:00:00') $device_protected_flag = false;
                if($time > '16:00:00' && $time < '20:00:00') $device_protected_flag = false;
                break;
            case 6:
                if($time > '8:00:00' && $time < '12:00:00') $device_protected_flag = false;
            default:
                break;
        }
        if($device->protected && !$device_protected_flag) $device->update(['protected' => false]);
        if(!$device->protected && $device_protected_flag) $device->update(['protected' => true]);
    }
}

