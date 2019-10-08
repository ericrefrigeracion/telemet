<?php

namespace App\Jobs\Rule;

use App\Rule;
use App\Device;
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

        $devices = Device::where('admin_mon', true)->where('protection_id', '!=', 1)->where('protection_id', '!=', 4)->get();
        foreach($devices as $device)
        {
            if($device->protection_id == 2) $this->CommerceProtectedDeviceRevission($device);
            if($device->protection_id == 3) $this->RuleProtectedDeviceRevission($device);
        }
    }

    public function CommerceProtectedDeviceRevission(Device $device)
    {
        $day = now()->dayOfWeek;
        $time = now()->toTimeString();
        $device_protected_flag = true;

        switch ($day)
        {
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
        if(!$device->protected && $device_protected_flag)
        {
            $device->update(['protected' => true]);
            $device->tiny_t_device->update([
                'on_t_set_point' => true,
                'on_temp' => true,
                't_change_at' => now(),
                't_out_at' => null,
            ]);
        }
    }

    public function RuleProtectedDeviceRevission(Device $device)
    {
        $day = now()->dayOfWeek;
        $time = now()->toTimeString();
        $device_protected_flag = true;
        $every_day = Rule::where('device_id', $device->id)->where('day', 'Todos los Dias')->get();

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
                break;
        }
        if(isset($rules)) foreach ($rules as $rule) if($rule->start_time < $time && $rule->stop_time > $time) $device_protected_flag = false;
        if(isset($every_day)) foreach ($every_day as $every) if($every->start_time < $time && $every->stop_time > $time) $device_protected_flag = false;

        if($device->protected && !$device_protected_flag) $device->update(['protected' => false]);
        if(!$device->protected && $device_protected_flag)
        {
            $device->update(['protected' => true]);
            $device->tiny_t_device->update([
                'on_t_set_point' => true,
                'on_temp' => true,
                't_change_at' => now(),
                't_out_at' => null,
            ]);
        }
    }
}
