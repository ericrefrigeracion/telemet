<?php

namespace App\Jobs;

use App\Alert;
use App\Device;
use App\MailAlert;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TinyTDevicesVerificationsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        $this->MaxTempVerification($devices);
        $this->MinTempVerification($devices);
        $this->TemperatureTimeVerification($devices);
        $this->SetPointChangeVerification($devices);
        $this->SetPointTimeVerification($devices);

    }

    public function MaxTempVerification($devices)
    {
        foreach($devices as $device)
        {
            $last_reception = $device->receptions()->latest()->first();
            $last_reception->data01 += $device->tiny_t_device->tcal;

            if($last_reception->data01 > $device->tiny_t_device->tmax && $device->tiny_t_device->on_temp)
            {
                $device->tiny_t_device->on_temp = false;
                $device->tiny_t_device->t_out_at = $last_reception->created_at;
                $device->tiny_t_device->update();

                Alert::create([
                    'device_id' => $device->id,
                    'log' => 'La temperatura se encuentra por encima de la maxima permitida.',
                    'alert_created_at' => $last_reception->created_at
                ]);
            }
            if($last_reception->data01 < $device->tiny_t_device->tmax && $last_reception->data01 > $device->tiny_t_device->tmin && !$device->tiny_t_device->on_temp)
            {
                $device->tiny_t_device->on_temp = true;
                $device->tiny_t_device->t_out_at = null;
                $device->tiny_t_device->update();
            }
        }
    }

    public function MinTempVerification($devices)
    {
        foreach($devices as $device)
        {
            $last_reception = $device->receptions()->latest()->first();
            $last_reception->data01 += $device->tiny_t_device->tcal;

            if($last_reception->data01 < $device->tiny_t_device->tmin && $device->tiny_t_device->on_temp)
            {
                $device->tiny_t_device->on_temp = false;
                $device->tiny_t_device->t_out_at = $last_reception->created_at;
                $device->tiny_t_device->update();

                Alert::create([
                    'device_id' => $device->id,
                    'log' => 'La temperatura se encuentra por debajo de la minima permitida.',
                    'alert_created_at' => $last_reception->created_at
                ]);
            }
            if($last_reception->data01 < $device->tiny_t_device->tmax && $last_reception->data01 > $device->tiny_t_device->tmin && !$device->tiny_t_device->on_temp)
            {
                $device->tiny_t_device->on_temp = true;
                $device->tiny_t_device->t_out_at = null;
                $device->tiny_t_device->update();
            }
        }
    }

    public function SetPointChangeVerification($devices)
    {
        foreach($devices as $device)
        {
            $last_reception = $device->receptions()->latest()->first();
            $last_reception->data01 += $device->tiny_t_device->tcal;

            if($last_reception->data01 > $device->tiny_t_device->t_set_point && $device->tiny_t_device->t_is === 'lower')
            {
                $device->tiny_t_device->t_is = 'higher';
                $device->tiny_t_device->t_change_at = $last_reception->created_at;
                $device->tiny_t_device->update();
            }
            if($last_reception->data01 < $device->tiny_t_device->t_set_point && $device->tiny_t_device->t_is === 'higher')
            {
                $device->tiny_t_device->t_is = 'lower';
                $device->tiny_t_device->t_change_at = $last_reception->created_at;
                $device->tiny_t_device->update();
            }
        }
    }

    public function TemperatureTimeVerification($devices)
    {
        foreach($devices as $device)
        {
            if(!$device->tiny_t_device->on_temp)
            {
                $delay = now()->subMinutes($device->tiny_t_device->tdly);

                if ($device->tiny_t_device->t_out_at <= $delay)
                {
                    if(!MailAlert::where('device_id', $device->id)->where('type', 'temp')->where('last_created_at', $device->tiny_t_device->t_out_at)->count())
                    {
                        MailAlert::create([
                            'device_id' => $device->id,
                            'user_id' => $device->user_id,
                            'type' => 'temp',
                            'last_created_at' => $device->tiny_t_device->t_out_at,
                        ]);
                    }
                }
            }
        }
    }

    public function SetPointTimeVerification($devices)
    {
        foreach($devices as $device)
        {
            $delay = now()->subMinutes($device->tiny_t_device->tdly);

            if ($device->tiny_t_device->t_change_at <= $delay && $device->tiny_t_device->on_t_set_point)
            {
                $device->tiny_t_device->update(['on_t_set_point' => false]);

                Alert::create([
                    'device_id' => $device->id,
                    'log' => 'La temperatura no alcanzo el valor deseado en el tiempo previsto.',
                    'alert_created_at' => $device->tiny_t_device->t_change_at,
                ]);

                MailAlert::create([
                    'device_id' => $device->id,
                    'user_id' => $device->user_id,
                    'type' => 'tSetPoint',
                    'last_created_at' => $device->tiny_t_device->t_change_at,
                ]);
            }
            if ($device->tiny_t_device->t_change_at > $delay && !$device->tiny_t_device->on_t_set_point)
            {
                $device->tiny_t_device->on_t_set_point = true;
                $device->tiny_t_device->update();
            }
        }
    }





}
