<?php

namespace App\Jobs\Rule;

use App\Device;
use App\Jobs\Rule\AlwaysProtectedDeviceRevissionJob;
use App\Jobs\Rule\CommerceProtectedDeviceRevissionJob;
use App\Jobs\Rule\RuleProtectedDeviceRevissionJob;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProtectedDeviceRevissionJob implements ShouldQueue
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
        $devices = Device::where('admin_mon', true)->get();

        foreach($devices as $device)
        {
            if($device->protection_id == 1 && !$device->protected) AlwaysProtectedDevice($device);
            if($device->protection_id == 2) CommerceProtectedDeviceRevissionJob::dispatch($device);
            if($device->protection_id == 3) RuleProtectedDeviceRevissionJob::dispatch($device);
            if($device->protection_id == 4 && $device->protected) NeverProtectedDeviceRevissionJob::dispatch($device);
        }
    }

    public function AlwaysProtectedDevice(Device $device)
    {
        $device->update(['protected' => true]);
    }
}
