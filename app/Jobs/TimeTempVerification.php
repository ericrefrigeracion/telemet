<?php

namespace App\Jobs;

use App\Device;
use App\Reception;
use App\MailAlert;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TimeTempVerification implements ShouldQueue
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
        $devices = Device::where('tmon', true)->where('admin_mon', true)->where('on_line', true)->where('on_temp', false)->get();

        foreach($devices as $device)
        {
            $delay = now()->subMinutes($device->tdly);

            if ($device->t_out_at <= $delay)
            {
                if(!MailAlert::where('device_id', $device->id)->where('type', 'temp')->where('last_created_at', $device->t_out_at)->count())
                {
                    MailAlert::create([
                        'device_id' => $device->id,
                        'user_id' => $device->user_id,
                        'type' => 'temp',
                        'last_created_at' => $device->t_out_at,
                    ]);
                }
            }
        }
    }
}
