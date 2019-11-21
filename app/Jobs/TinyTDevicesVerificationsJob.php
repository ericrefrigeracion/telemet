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
    }

    public function allVerifications($devices)
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
            if(!$before_reception->data01) $before_reception->data01 = $device->tiny_t_device->t_set_point;

            $this->maxTempVerification($device, $last_reception);
            $this->minTempVerification($device, $last_reception);
            $this->temperatureTimeVerification($device);
            $this->setPointChangeVerification($device, $last_reception);
            $this->setPointTimeVerification($device);
            $this->avgForTime($device, $last_reception, $last_hour, 'data02');
            $this->avgForTime($device, $last_reception, $last_six_hours, 'data03');
            $this->avgForTime($device, $last_reception, $last_twelve_hours, 'data04');
            $this->avgForTime($device, $last_reception, $last_day, 'data05');
            $this->proportional($device, $last_reception, 'data06');
            $this->integral($device, $last_reception, $before_reception, 'data07');
            $this->derivate($device, $last_reception, $before_reception, 'data08');
        }
    }

    public function maxTempVerification($device, $last_reception)
    {
            if($last_reception->data01 > $device->tiny_t_device->tmax && $device->tiny_t_device->on_temp && $last_reception->data01 != 85)
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
            if($last_reception->data01 < $device->tiny_t_device->tmin && $device->tiny_t_device->on_temp && $last_reception->data01 != -127)
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

    public function avgForTime($device, $last_reception, $time, $field)
    {
        $avg = $device->receptions()->where('created_at', '>', $time)->avg('data01');
        $last_reception->update([$field => $avg]);
    }

    public function proportional($device, $last_reception, $field)
    {
        $proportional = $last_reception->data01 - $device->tiny_t_device->t_set_point;
        if($proportional > 50) $proportional = 50;
        if($proportional < -50) $proportional = -50;
        $last_reception->update([$field => $proportional]);
    }

    public function integral($device, $last_reception, $before_reception, $field)
    {
        $integral = $before_reception->data06 + $last_reception->data07;
        if($integral > 1000) $integral = 1000;
        if($integral < -1000) $integral = -1000;
        $last_reception->update([$field => $integral]);
    }

    public function derivate($device, $last_reception, $before_reception, $field)
    {
        $derivate = $before_reception->data01 - $last_reception->data01;
        $state = 0;
        if($derivate > 0) $state = 1;
        if($derivate < 0) $state = -1;
        if($derivate > 5) $derivate = 5;
        if($derivate < -5) $derivate = -5;
        $last_reception->update([
            $field => $derivate,
            'data09' => $state
        ]);
    }

}
