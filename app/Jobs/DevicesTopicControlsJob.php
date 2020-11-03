<?php

namespace App\Jobs;

use App\Device;
use App\DataReception;
use App\DeviceConfiguration;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DevicesTopicControlsJob implements ShouldQueue
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
        $this->topicControl();
    }

    public function topicControl()
    {
        $on_line_time = now()->subMinutes(10);
        $performance_time = now()->subHours(2);

        $devices = Device::where('protected', true)->where('admin_mon', true)->get();
        $device_configurations = DeviceConfiguration::all();
        $data_receptions = DataReception::where('created_at', '>', $performance_time)->get();

        $on_line_data_receptions = $data_receptions->where('created_at', '>', $on_line_time);

        foreach ($devices as $device)
        {

            if($this->isOnLine($device, $on_line_data_receptions))
            {
                $configurations = $device_configurations->where('device_id', $device->id);

                foreach ($configurations as $configuration)
                {
                    $last_reception = $on_line_data_receptions->where('topic', $configuration->topic->slug)
                                                            ->where('device_id', $configuration->device_id)->last();
                    switch ($configuration->topic_control_type_id)
                    {
                        case 1:
                            if($last_reception) $this->calibrationControl($last_reception, $configuration);
                            break;
                        case 2:
                            if($last_reception) $this->minimumControl($last_reception, $configuration);
                            break;
                        case 3:
                            if($last_reception) $this->maximumControl($last_reception, $configuration);
                            break;
                        case 4:
                            if($last_reception) $this->performanceControl($last_reception, $data_receptions, $configuration);
                            break;
                        case 5:
                            $this->delayControl($configurations, $configuration);
                            break;
                        default:
                            break;
                    }

                }

            }

        }
    }

    public function isOnLine($device, $on_line_data_receptions)
    {
        $receptions = $on_line_data_receptions->where('device_id', $device->id);

        if($receptions->isNotEmpty() && !$device->on_line)
        {
            $device->update(['on_line' => true]);
            alertCreate($device, 'El dispositivo esta conectado.', now());
            mailAlertCreate($device, 'onLine', now());
        }
        if($receptions->isEmpty() && $device->on_line)
        {
            $device->update(['on_line' => false]);
            alertCreate($device, 'El dispositivo esta desconectado.', now());
            mailAlertCreate($device, 'offLine', now());
        }

        return $device->on_line;
    }

    public function calibrationControl($last_reception, $configuration)
    {
        if(strpos($last_reception->status, $configuration->topic_control_type->slug) === false || $last_reception->status === null)
        {
            $status = $last_reception->status . $configuration->topic_control_type->slug . ' ';
            $value = round(($last_reception->value + $configuration->value), 2);
            $last_reception->update([
                'status' => $status,
                'value' => $value
            ]);
        }
    }

    public function minimumControl($last_reception, $configuration)
    {
        if(strpos($last_reception->status, $configuration->topic_control_type->slug) === false || $last_reception->status === null)
        {
            $status = $last_reception->status . $configuration->topic_control_type->slug . ' ';
            $last_reception->update(['status' => $status]);

            if($last_reception->value < $configuration->value && $configuration->status_id == 1)
            {
                alertCreate($configuration->device, 'El valor de ' . $configuration->topic->name . ' se encuentra por debajo de la minima permitida.', $last_reception->created_at);

                $configuration->device->update(['status_id' => 2]);
                $configuration->update([
                    'status_id' => 2,
                    'status_at' => $last_reception->created_at,
                ]);
            }
            if($last_reception->value >= $configuration->value && $configuration->status_id != 1)
            {
                $configuration->device->update(['status_id' => 1]);
                $configuration->update([
                    'status_id' => 1,
                    'status_at' => null,
                ]);
            }
        }
    }

    public function maximumControl($last_reception, $configuration)
    {
        if(strpos($last_reception->status, $configuration->topic_control_type->slug) === false || $last_reception->status === null)
        {
            $status = $last_reception->status . $configuration->topic_control_type->slug . ' ';
            $last_reception->update(['status' => $status]);
            if($last_reception->value > $configuration->value && $configuration->status_id == 1)
            {
                alertCreate($configuration->device, 'El valor de ' . $configuration->topic->name . ' se encuentra por encima de la maxima permitida.', $last_reception->created_at);
                $configuration->device->update(['status_id' => 2]);
                $configuration->update([
                    'status_id' => 2,
                    'status_at' => $last_reception->created_at,
                ]);
            }
            if($last_reception->value <= $configuration->value && $configuration->status_id != 1)
            {
                $configuration->device->update(['status_id' => 1]);
                $configuration->update([
                    'status_id' => 1,
                    'status_at' => null,
                ]);
            }

        }
    }

    public function performanceControl($last_reception, $data_receptions, $configuration)
    {
        $this->derivate($last_reception, $data_receptions, $configuration);
        $this->performance($data_receptions, $configuration);
    }

    public function delayControl($configurations, $configuration)
    {
        foreach ($configurations as $config)
        {
            if($config->status_at < now()->subMinutes($configuration->value) && $config->status_id != 3 && $config->status_at != null)
            {
                mailAlertCreate($config->device, $config->topic_control_type->slug, $config->status_at);
                $log = 'Se alcanzo el punto critico para la ' . $config->topic_control_type->name . ' ' . $config->topic->name . '.';
                alertCreate($config->device, $log, now());

                $config->device->update(['status_id' => 3]);
                $config->update([
                    'status_id' => 3,
                    'status_at' => now(),
                ]);
            }

        }
    }


    public function derivate($last_reception, $data_receptions, $configuration)
    {
        if(strpos($last_reception->status, $configuration->topic_control_type->slug) === false || $last_reception->status === null)
        {
            $status = $last_reception->status . $configuration->topic_control_type->slug . ' ';
            $last_reception->update(['status' => $status]);

            $before_reception = $data_receptions->where('topic', $configuration->topic->slug)->where('device_id', $configuration->device_id)->where('created_at', '<', $last_reception->created_at)->last();

            if(!$before_reception) $before_reception = $last_reception;
            $derivate = $before_reception->value - $last_reception->value;
            if($derivate > 10) $derivate = 10;
            if($derivate < -10) $derivate = -10;

            DataReception::create([
                'device_id' => $configuration->device_id,
                'topic' => $configuration->topic->slug . '_derivate',
                'value' => $derivate,
                'status' => 'perf',
            ]);
        }
    }

    public function performance($data_receptions, $configuration)
    {
        $performance = $data_receptions->where('topic', $configuration->topic->slug . '_derivate')->where('device_id', $configuration->device_id)->where('value', '>', 0)->sum('value');
        if($performance > 40) $performance = 40;
        if($performance < 0) $performance = 0;

        DataReception::create([
            'device_id' => $configuration->device_id,
            'topic' => $configuration->topic->slug . '_performance',
            'value' => $performance,
            'status' => 'perf',
        ]);

        if($performance < $configuration->value && $configuration->status_id == 1)
            {
                alertCreate($configuration->device, 'El valor de ' . $configuration->topic_control_type->name . ' se encuentra por debajo de la minima esperada.', now());
                $configuration->device->update(['status_id' => 2]);
                $configuration->update([
                    'status_id' => 2,
                    'status_at' => now(),
                ]);
            }
            if($performance > $configuration->value && $configuration->status_id != 1)
            {
                $configuration->device->update(['status_id' => 1]);
                $configuration->update([
                    'status_id' => 1,
                    'status_at' => null,
                ]);
            }
    }


}
