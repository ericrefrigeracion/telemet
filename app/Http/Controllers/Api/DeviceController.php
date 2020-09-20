<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Alert;
use App\Device;
use App\Reception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeviceController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        if($request->ajax())
        {
            $last_day = now()->subDay();
            $devices = Device::where('admin_mon', true)->where('protected', true)->orderBy('user_id', 'asc')->get();
            foreach ($devices as $device)
            {
                if($device->type_device_id == 2)
                {
                    if($device->tiny_t_device()->firstOrFail()->on_temp)
                    {
                        $device->title_1 = 'Temperatura dentro de los Limites';
                        $device->class_1 = 'fas fa-temperature-high text-success m-2';
                    }
                    else
                    {
                        $device->title_1 = 'Temperatura fuera de los Limites';
                        $device->class_1 = 'fas fa-temperature-high text-danger m-2';
                    }
                    if($device->tiny_t_device()->firstOrFail()->on_performance)
                    {
                        $device->title_2 = 'Rendimiento Normal';
                        $device->class_2 = 'far fa-check-circle text-success m-2';
                    }
                    else
                    {
                        $device->title_2 = 'Rendimiento Bajo';
                        $device->class_2 = 'far fa-times-circle text-danger m-2';
                    }
                }
                if($device->type_device_id == 7)
                {
                    if($device->tiny_pump_device()->firstOrFail()->on_level)
                    {
                        $device->title_1 = 'Nivel dentro de los Limites';
                        $device->class_1 = 'fas fa-water text-success m-2';
                    }
                    else
                    {
                        $device->title_1 = 'Nivel fuera de los Limites';
                        $device->class_1 = 'fas fa-water text-danger m-2';
                    }
                    if($device->tiny_pump_device()->firstOrFail()->on_level)
                    {
                        $device->title_2 = 'Funcionamiento Normal';
                        $device->class_2 = 'far fa-check-circle text-success m-2';
                    }
                    else
                    {
                        $device->title_2 = 'Funcionamiento Anormal';
                        $device->class_2 = 'far fa-times-circle text-danger m-2';
                    }
                }
                $device->route = route('devices.show', $device->id);
                $device->user_route = route('users.show', $device->user_id);
                $device->receptions_route = route('receptions.now', $device->id);
                $device->configuration_route = route('devices.edit', $device->id);
                $device->logs_route = route('devices.log', $device->id);
                $device->alerts_route = route('alerts.show', $device->id);
                $device->alerts_count = Alert::where('device_id', $device->id)->where('created_at', '>=', $last_day)->count();
                $device->last_reception_created_at = Reception::where('device_id', $device->id)->latest()->first()->created_at;
            }
            return $devices;
        }
        else
        {
            return redirect()->route('home');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tiny_t_index(Request $request, User $user)
    {
        if($request->ajax())
        {
            $tiny_t_devices = $user->devices()->where('type_device_id', 2)->get();

            foreach ($tiny_t_devices as $device)
            {

                $device->last_data01 = 'Sin datos';
                $device->last_created_at = 'Sin datos';
                $device->signal_class = 'fas fa-wifi text-muted m-2';
                $device->status_class = 'far fa-times-circle text-muted m-2 ml-3';
                $device->signal_title = 'Sin Conexion';
                $device->status_text = 'Sin datos';
                $device->statuss_class = ''; //far fa-times-circle text-muted col-2 h1 mt-3
                $device->statuss_title = 'Sin datos';
                $device->bg_class = 'bg-danger';

                $device->receptions_route = route('receptions.now', $device->id);
                $device->configuration_route = route('devices.edit', $device->id);
                $device->pay_route = route('pays.create', $device->id);
                $device->alerts_route = route('alerts.show', $device->id);

                $device->protection_class = $device->protection->class;
                $device->protection_title = $device->protection->description;

                if($device->admin_mon && $device->protected)
                {
                    $last_reception = Reception::where('device_id', $device->id)->where('data01', '!=', NULL)->where('data04', '!=', NULL)->latest()->first();
                }
                else
                {
                    $last_reception = Reception::where('device_id', $device->id)->where('data01', '!=', NULL)->latest()->first();
                }
                if($last_reception)
                {
                    $device->last_created_at = $last_reception->created_at;
                    if($device->on_line)
                    {
                        $device->last_data01 = round($last_reception->data01, 1) + $device->tiny_t_device->tcal . '°C';
                        $device->bg_class = '';

                        if ($last_reception->rssi >= -60)
                        {
                             $device->signal_class = 'fas fa-wifi text-success m-2';
                             $device->signal_title = 'Señal WiFi Buena';
                        }
                        if ($last_reception->rssi > -75 && $last_reception->rssi < -60)
                        {
                             $device->signal_class = 'fas fa-wifi text-warning m-2';
                             $device->signal_title = 'Señal WiFi Aceptable';
                        }
                        if ($last_reception->rssi < -75)
                        {
                             $device->signal_class = 'fas fa-wifi text-danger m-2';
                             $device->signal_title = 'Señal WiFi Mala';
                        }

                        if($device->admin_mon && $device->protected)
                        {
                            if($last_reception->data04)
                            {
                                $device->statuss_class = 'fas fa-arrow-circle-down text-info col-2 h1 mt-3';
                                $device->statuss_title = 'Enfriando';
                            }
                            else
                            {
                                $device->statuss_class = 'fas fa-arrow-circle-up text-warning col-2 h1 mt-3';
                                $device->statuss_title = 'Reposo';
                            }
                            if($device->tiny_t_device->on_temp  && $device->tiny_t_device->on_performance)
                            {
                                $device->status_text = 'Todo en Orden';
                                $device->status_class = 'far fa-check-circle text-success m-2';
                                $device->bg_class = 'bg-success';
                            }
                            if(!$device->tiny_t_device->on_temp  && $device->tiny_t_device->on_performance)
                            {
                                $device->status_text = 'Fuera de Rango';
                                $device->status_class = 'fas fa-exclamation text-warning m-2';
                                $device->bg_class = 'bg-warning';
                            }
                            if($device->tiny_t_device->on_temp  && !$device->tiny_t_device->on_performance)
                            {
                                $device->status_text = 'Bajo Rendimiento';
                                $device->status_class = 'fas fa-exclamation text-warning m-2';
                                $device->bg_class = 'bg-warning';
                            }
                            if(!$device->tiny_t_device->on_temp  && !$device->tiny_t_device->on_performance)
                            {
                                $device->status_text = 'ALERTA';
                                $device->status_class = 'fas fa-exclamation text-danger m-2';
                                $device->bg_class = 'bg-danger';
                            }
                        }
                    }
                }
                $device->alerts_count = Alert::where('device_id', $device->id)->where('created_at', '>', $device->view_alerts_at)->count();
            }
            return $tiny_t_devices;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tiny_pump_index(Request $request, User $user)
    {
        if($request->ajax())
        {

            $tiny_pump_devices = $user->devices()->where('type_device_id', 7)->get();

            foreach ($tiny_pump_devices as $device)
            {
                $device->last_data01 = 'Sin datos';
                $device->last_created_at = 'Sin datos';
                $device->signal_class = 'fas fa-wifi text-muted m-2';
                $device->signal_title = 'Sin Conexion';
                $device->channel1_class = 'far fa-times-circle text-muted m-2 mr-3';
                $device->channel1_title = 'Sin datos';
                $device->channel2_class = 'far fa-times-circle text-muted m-2';
                $device->channel2_title = 'Sin datos';
                $device->channel3_class = 'far fa-times-circle text-muted m-2 ml-3';
                $device->channel3_title = 'Sin datos';
                $device->bg_class = 'bg-danger';
                $device->receptions_route = route('receptions.now', $device->id);
                $device->configuration_route = route('devices.edit', $device->id);
                $device->logs_route = route('devices.log', $device->id);
                $device->alerts_route = route('alerts.show', $device->id);

                $device->protection_class = $device->protection->class;
                $device->protection_title = $device->protection->description;

                if($last_reception = $device->receptions()->where('data01', '!=', NULL)->latest()->first())
                {
                    if($device->on_line)
                    {
                        $device->last_data01 = $last_reception->data01 + $device->tiny_pump_device->l_cal . 'cms';
                        $device->bg_class = '';

                        if ($last_reception->rssi >= -60)
                        {
                             $device->signal_class = 'fas fa-wifi text-success m-2';
                             $device->signal_title = 'Señal Celular Buena';
                        }
                        if ($last_reception->rssi > -75 && $last_reception->rssi < -60)
                        {
                             $device->signal_class = 'fas fa-wifi text-warning m-2';
                             $device->signal_title = 'Señal Celular Aceptable';
                        }
                        if ($last_reception->rssi < -75)
                        {
                             $device->signal_class = 'fas fa-wifi text-danger m-2';
                             $device->signal_title = 'Señal Celular Mala';
                        }
                        if($device->tiny_pump_device->channel1_status == 'disabled')
                        {
                            $device->channel1_class = 'far fa-check-circle text-muted m-2 mr-3';
                            $device->channel1_title = 'Canal Deshabilitado';
                        }
                        if($device->tiny_pump_device->channel1_status == 'success')
                        {
                            $device->channel1_class = 'far fa-check-circle text-success m-2 mr-3';
                            $device->channel1_title = 'Todo en Orden';
                        }
                        if($device->tiny_pump_device->channel1_status == 'warning')
                        {
                            $device->channel1_class = 'tfar fa-check-circle text-warning m-2 mr-3';
                            $device->channel1_title = 'Atencion';
                        }
                        if($device->tiny_pump_device->channel1_status == 'danger')
                        {
                            $device->channel1_class = 'far fa-check-circle text-danger m-2 mr-3';
                            $device->channel1_title = 'Falla';
                        }
                        if($device->tiny_pump_device->channel2_status == 'disabled')
                        {
                            $device->channel2_class = 'far fa-check-circle text-muted m-2';
                            $device->channel2_title = 'Canal Deshabilitado';
                        }
                        if($device->tiny_pump_device->channel2_status == 'success')
                        {
                            $device->channel2_class = 'far fa-check-circle text-success m-2';
                            $device->channel2_title = 'Todo en Orden';
                        }
                        if($device->tiny_pump_device->channel2_status == 'warning')
                        {
                            $device->channel2_class = 'far fa-check-circle text-warning m-2';
                            $device->channel2_title = 'Atencion';
                        }
                        if($device->tiny_pump_device->channel2_status == 'danger')
                        {
                            $device->channel2_class = 'far fa-check-circle text-danger m-2';
                            $device->channel2_title = 'Falla';
                        }
                        if($device->tiny_pump_device->channel3_status == 'disabled')
                        {
                            $device->channel3_class = 'far fa-check-circle text-muted m-2 ml-3';
                            $device->channel3_title = 'Canal Deshabilitado';
                        }
                        if($device->tiny_pump_device->channel3_status == 'success')
                        {
                            $device->channel3_class = 'far fa-check-circle text-success m-2 ml-3';
                            $device->channel3_title = 'Todo en Orden';
                        }
                        if($device->tiny_pump_device->channel3_status == 'warning')
                        {
                            $device->channel3_class = 'far fa-check-circle text-warning m-2 ml-3';
                            $device->channel3_title = 'Atencion';
                        }
                        if($device->tiny_pump_device->channel3_status == 'danger')
                        {
                            $device->channel3_class = 'far fa-check-circle text-danger m-2 ml-3';
                            $device->channel3_title = 'Falla';
                        }
                    }
                    $device->last_created_at = $last_reception->created_at;
                }
                $device->alerts_count = $device->alerts()->where('created_at', '>', $device->view_alerts_at)->count();
            }
            return $tiny_pump_devices;
        }
        else
        {
            return redirect()->route('home');
        }
    }
}
