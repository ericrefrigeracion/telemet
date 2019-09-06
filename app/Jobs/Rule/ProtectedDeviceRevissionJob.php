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
            if($device->rule_type == 'Siempre Protegido' && !$device->protected) AlwaysProtectedDeviceRevissionJob::dispatch($device);
            if($device->rule_type == 'Protegido cuando cierro mi Comercio') CommerceProtectedDeviceRevissionJob::dispatch($device);
            if($device->rule_type == 'Con horarios Permitidos (Perzonalizado)') RuleProtectedDeviceRevissionJob::dispatch($device);
        }
    }
}
