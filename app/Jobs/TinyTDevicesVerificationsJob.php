<?php

namespace App\Jobs;

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

        $devices = Device::where('admin_mon', true)->where('on_line', true)->where('type_device_id', 2)->get();
        if($devices->isNotEmpty()) $this->allCalcs($devices);
    }

    public function allVerifications($devices)
    {
        foreach ($devices as $device)
        {
            $last_reception = $device->receptions()->latest()->first();
            $last_reception->data01 += $device->tiny_t_device->tcal;

            $this->maxTempVerification($device, $last_reception);
            $this->minTempVerification($device, $last_reception);
            $this->temperatureTimeVerification($device);
            $this->setPointChangeVerification($device, $last_reception);
            $this->setPointTimeVerification($device);
        }
    }

    public function allCalcs($devices)
    {
        $last_hour = now()->subHour();
        $last_six_hours = now()->subHours(6);
        $last_twelve_hours = now()->subHours(12);
        $last_day = now()->subDay();

        foreach ($devices as $device)
        {
            $last_reception = $device->receptions()->latest()->first();
            $last_reception->data01 += $device->tiny_t_device->tcal;
            $before_reception = $device->receptions()->where('created_at', '<', $last_reception->created_at)->latest()->first();
            $before_reception->data01 += $device->tiny_t_device->tcal;
            if(!$before_reception->data01) $before_reception->data01 = $last_reception->data01;

            $this->avgS($device, $last_reception, $last_hour, $last_six_hours, $last_twelve_hours, $last_day);
            $this->pID($device, $last_reception, $before_reception);
        }
    }

    public function maxTempVerification($device, $last_reception)
    {
            if($last_reception->data01 > $device->tiny_t_device->tmax && $device->tiny_t_device->on_temp)
            {
                $this->isOutTemperature($device, $last_reception->created_at);
                alertCreate($device, 'La temperatura se encuentra por encima de la maxima permitida.', $last_reception->created_at);
            }
            if($last_reception->data01 < $device->tiny_t_device->tmax && $last_reception->data01 > $device->tiny_t_device->tmin && !$device->tiny_t_device->on_temp)
            {
                $this->isOnTemperature($device);
            }
    }

    public function minTempVerification($device, $last_reception)
    {
            if($last_reception->data01 < $device->tiny_t_device->tmin && $device->tiny_t_device->on_temp)
            {
                $this->isOutTemperature($device, $last_reception->created_at);
                alertCreate($device, 'La temperatura se encuentra por debajo de la minima permitida.', $last_reception->created_at);
            }
            if($last_reception->data01 < $device->tiny_t_device->tmax && $last_reception->data01 > $device->tiny_t_device->tmin && !$device->tiny_t_device->on_temp)
            {
                $this->isOnTemperature($device);
            }
    }

    public function temperatureTimeVerification($device)
    {
            if(!$device->tiny_t_device->on_temp)
            {
                $delay = now()->subMinutes($device->tiny_t_device->tdly);

                if ($device->tiny_t_device->t_out_at <= $delay)
                {
                    if(!MailAlert::where('device_id', $device->id)->where('type', 'temp')->where('last_created_at', $device->tiny_t_device->t_out_at)->count())
                    {
                        mailAlertCreate($device, 'temp', $device->tiny_t_device->t_out_at);
                    }
                }
            }
    }

    public function setPointChangeVerification($device, $last_reception)
    {
            if($last_reception->data01 > $device->tiny_t_device->t_set_point && $device->tiny_t_device->t_is === 'lower')
            {
                $device->tiny_t_device->update([
                    't_is' => 'higher',
                    't_change_at' => $last_reception->created_at
                ]);
            }
            if($last_reception->data01 < $device->tiny_t_device->t_set_point && $device->tiny_t_device->t_is === 'higher')
            {
                $device->tiny_t_device->update([
                    't_is' => 'lower',
                    't_change_at' => $last_reception->created_at
                ]);
            }
            if($last_reception->data01 == $device->tiny_t_device->t_set_point)
            {
                $device->tiny_t_device->update([
                    't_change_at' => $last_reception->created_at
                ]);
            }
    }

    public function setPointTimeVerification($device)
    {
            $delay = now()->subMinutes($device->tiny_t_device->tdly);

            if ($device->tiny_t_device->t_change_at <= $delay && $device->tiny_t_device->on_t_set_point)
            {
                $device->tiny_t_device->update(['on_t_set_point' => false]);
                alertCreate($device, 'La temperatura no alcanzo el valor deseado en el tiempo previsto.', $device->tiny_t_device->t_change_at);
                mailAlertCreate($device, 'tSetPoint', $device->tiny_t_device->t_change_at);
            }
            if ($device->tiny_t_device->t_change_at > $delay && !$device->tiny_t_device->on_t_set_point) $device->tiny_t_device->update(['on_t_set_point' => true]);
    }

    public function isOnTemperature($device)
    {
        $device->tiny_t_device->update([
            'on_temp' => true,
            't_out_at' => null
        ]);
    }

    public function isOutTemperature($device, $moment)
    {
        $device->tiny_t_device->update([
            'on_temp' => false,
            't_out_at' => $moment
        ]);
    }

    public function avgS($device, $last_reception, $last_hour, $last_six_hours, $last_twelve_hours, $last_day)
    {
        $avg_last_hour = $device->receptions()->where('created_at', '>', $last_hour)->avg('data01');
        $avg_last_six = $device->receptions()->where('created_at', '>', $last_six_hours)->avg('data01');
        $avg_last_twelve = $device->receptions()->where('created_at', '>', $last_twelve_hours)->avg('data01');
        $avg_last_day = $device->receptions()->where('created_at', '>', $last_day)->avg('data01');

        $last_reception->update([
            'data02' => $avg_last_hour,
            'data03' => $avg_last_six,
            'data04' => $avg_last_twelve,
            'data05' => $avg_last_day,
        ]);
    }

    public function pID($device, $last_reception, $before_reception)
    {
        $proportional = $last_reception->data01 - $device->tiny_t_device->t_set_point;
        if($proportional > 50) $proportional = 50;
        if($proportional < -50) $proportional = -50;

        $integral = null;

        $derivate = $before_reception->data01 - $last_reception->data01;
        if($derivate > 10) $derivate = 10;
        if($derivate < -10) $derivate = -10;

        $status = 0;
        if($derivate <= 0) $status = 1;
        if($derivate > 0) $status = 0;

        $status_count = 0;
        if(isset($last_reception->data10)) $status_count = $last_reception->data10;

        $before_status = 0;
        if(isset($before_reception->data09)) $before_status = $before_reception->data09;

        if($before_status != $status && $status_count <= 2) $status_count ++;
        if($before_status == $status && $status_count > 0) $status_count --;

        if($status_count > 2 && $before_status) $before_status = 0;
        if($status_count > 2 && !$before_status) $before_status = 1;

        $last_reception->update([
            'data06' => $proportional,
            'data07' => $integral,
            'data08' => $derivate,
            'data09' => $before_status,
            'data10' => $status_count
        ]);
    }

}
