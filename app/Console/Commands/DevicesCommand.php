<?php

namespace App\Console\Commands;

use App\Jobs\Mail\SendAdminMails;
use App\Jobs\Pay\PayVigentVerification;
use App\Jobs\Humidity\HumidityVerificationJob;
use App\Jobs\Humidity\MaxHumVerification;
use App\Jobs\Humidity\MinHumVerification;
use App\Jobs\Humidity\TimeHumVerification;
use App\Jobs\Humidity\SetPointHumChangeVerification;
use App\Jobs\Temperature\TemperatureVerificationJob;
use App\Jobs\Temperature\MaxTempVerification;
use App\Jobs\Temperature\MinTempVerification;
use App\Jobs\Temperature\TimeTempVerification;
use App\Jobs\Temperature\SetPointTempChangeVerification;
use App\Jobs\Rule\ProtectedDeviceRevissionJob;
use App\Jobs\Disconnect\DisconnectVerification;
use App\Jobs\SetPoint\TimeSetPointVerification;
use Illuminate\Console\Command;

class DevicesCommand extends Command
{

    protected $signature = 'devices:revissions';
    protected $description = 'Revisa el estado de los dispositivos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        PayVigentVerification::dispatch();
        DisconnectVerification::dispatch();
        ProtectedDeviceRevissionJob::dispatch();
        TemperatureVerificationJob::dispatch();
        //HumidityVerificationJob::dispatch();
        TimeSetPointVerification::dispatch();
        SendAdminMails::dispatch();
    }
}
