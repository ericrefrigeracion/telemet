<?php

namespace App\Jobs;

use App\Device;
use App\MailAlert;
use App\Reception;
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
            $last_reception = $device->receptions()->where('data01', '!=', null)->latest()->first();
            $last_reception->data01 += $device->tiny_t_device->tcal;

            $this->maxTempVerification($device, $last_reception);
            $this->minTempVerification($device, $last_reception);
            $this->temperatureTimeVerification($device);
        }
    }

    public function allCalcs($devices)
    {
        $product_time = now()->subHours(6);
        $cooling_time= now()->subHours(2);
        $status_time = now()->subMinutes(8);

        foreach ($devices as $device)
        {
            $last_reception = $device->receptions()->where('data01', '!=', null)->latest()->first();
            $before_reception = $device->receptions()->where('data01', '!=', null)
                                                    ->where('created_at', '<', $last_reception->created_at)->latest()->first();
            if(!isset($before_reception->data01)) $before_reception->data01 = $last_reception->data01;

            $this->productTemperature($device, $last_reception, $before_reception, $product_time, $cooling_time, $status_time);
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

    public function productTemperature($device, $last_reception, $before_reception, $product_time, $cooling_time, $status_time)
    {
        $product_temperature = $device->receptions()->where('created_at', '>', $product_time)->avg('data01');

        $derivate = $before_reception->data01 - $last_reception->data01;
        if($derivate > 10) $derivate = 10;
        if($derivate < -10) $derivate = -10;

        if(!isset($before_reception->data04)) $before_reception->data04 = 0;
        $derivate_avg = $device->receptions()->where('created_at', '>', $status_time)->avg('data03');
        if($derivate_avg > 0) $status = 1;
        if($derivate_avg == 0) $status = $before_reception->data04;
        if($derivate_avg < 0) $status = 0;

        $derivate_positive_sum = $device->receptions()->where('created_at', '>', $cooling_time)->where('data03', '>', 0)->sum('data03');
        if($derivate_positive_sum > 40) $derivate_positive_sum = 40;
        if($derivate_positive_sum < 0) $derivate_positive_sum = 0;

        $derivate_sum = $device->receptions()->where('created_at', '>', $cooling_time)->sum('data03');
        if($derivate_sum > 30) $derivate_sum = 30;
        if($derivate_sum < -30) $derivate_sum = -30;

        $last_reception->update([
            'data02' => $product_temperature,
            'data03' => $derivate,
            'data04' => $status,
            'data05' => $derivate_avg,
            'data06' => $derivate_positive_sum,
            'data07' => $derivate_sum
        ]);
    }
}
