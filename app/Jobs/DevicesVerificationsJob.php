<?php

namespace App\Jobs;

use App\Rule;
use App\Alert;
use App\Device;
use App\Reception;
use App\MailAlert;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DevicesVerificationsJob implements ShouldQueue
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

        $this->EliminatedReceptions();

        $devices = Device::all();
        $this->PayVigentVerification($devices);

        $devices = Device::where('admin_mon', true)->get();
        $this->DisconnectVerification($devices);

        $devices = Device::where('admin_mon', true)->where('protection_id', '!=', 1)->where('protection_id', '!=', 4)->get();
        $this->ProtectedVerification($devices);

    }

    public function EliminatedReceptions()
    {
        Reception::where('data01', -127)->delete();
        Reception::where('data01', 85)->delete();
        Reception::where('created_at', '<', now()->subDays(60))->delete();
    }

    public function PayVigentVerification($devices)
    {
        $current_time = now();
        $next_day = now()->addDay();
        $next_week = now()->addWeek();

        foreach ($devices as $device)
        {
            if($device->monitor_expires_at < $current_time && $device->admin_mon)
            {
                $device->update(['admin_mon' => false]);

                AlertCreate($device, 'Monitoreo deshabilitado por falta de pago.', $device->monitor_expires_at);
                MailAlertCreate($device, 'MonitorOff',$device->monitor_expires_at);
            }
            if($device->monitor_expires_at >= $current_time && !$device->admin_mon)
            {
                $device->update(['admin_mon' => true]);

                AlertCreate($device, 'Monitoreo habilitado nuevamente.', now());
                MailAlertCreate($device, 'MonitorOn',$device->monitor_expires_at);
            }
            if($device->monitor_expires_at < $next_day)
            {
                if(!MailAlert::where('device_id', $device->id)->where('type', 'MonitorOffNextDay')->where('last_created_at', $device->monitor_expires_at)->count())
                {
                    AlertCreate($device, 'Mañana se deshabilita monitoreo por falta de pago.', now());
                    MailAlertCreate($device, 'MonitorOffNextDay',$device->monitor_expires_at);
                }
            }
            if($device->monitor_expires_at < $next_week)
            {
                if(!MailAlert::where('device_id', $device->id)->where('type', 'MonitorOffNextWeek')->where('last_created_at', $device->monitor_expires_at)->count())
                {
                    AlertCreate($device, 'La semana proxima se deshabilita monitoreo por falta de pago.', now());
                    MailAlertCreate($device, 'MonitorOffNextWeek',$device->monitor_expires_at);
                }
            }
        }
    }

    public function DisconnectVerification($devices)
    {
        $delay = now()->subMinutes(10);

        foreach($devices as $device)
        {
            if($last_reception = $device->receptions()->latest()->first())
            {
                //Si el tiempo de recepcion es menor al delay(o sea mas viejo) && el dispositivo figura en linea
                //en la base de datos(on_line=true)
                if ( $last_reception->created_at < $delay && $device->on_line )
                {
                    $device->update(['on_line'=> false]);
                    AlertCreate($device, 'Ultima conexion del dispositivo.', $last_reception->created_at);
                    MailAlertCreate($device, 'offLine',$last_reception->created_at);
                }

                //Si el tiempo de recepcion es mayor al delay(o sea mas nuevo) && el dispocitivo figura fuera de linea
                //en la base de datos(on_line=false)
                if( $last_reception->created_at > $delay && !$device->on_line )
                {
                    $device->update(['on_line'=> true]);

                    AlertCreate($device, 'El dispositivo se conecto nuevamente.', $last_reception->created_at);
                    MailAlertCreate($device, 'onLine',$last_reception->created_at);
                }
            }
        }
    }

    public function ProtectedVerification($devices)
    {
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
