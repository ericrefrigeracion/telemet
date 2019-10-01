<?php

namespace App\Jobs\Rule;

use App\Device;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class NeverProtectedDeviceRevissionJob implements ShouldQueue
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
        $device->update(['protected' => false]);
    }
}
