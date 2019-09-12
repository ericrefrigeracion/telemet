<?php

namespace App\Console\Commands;

use App\Jobs\Reception\EliminateReceptionsJob;
use App\Jobs\Pay\PayVigentVerification;
use App\Jobs\Disconnect\DisconnectVerification;
use App\Jobs\Rule\ProtectedDeviceRevissionJob;
use App\Jobs\Temperature\TemperatureVerificationJob;
use App\Jobs\Humidity\HumidityVerificationJob;
use App\Jobs\SetPoint\TimeSetPointVerification;
use App\Jobs\Mail\SendAdminMails;
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
        EliminateReceptionsJob::dispatch();
        PayVigentVerification::dispatch();
        DisconnectVerification::dispatch();
        ProtectedDeviceRevissionJob::dispatch();
        TemperatureVerificationJob::dispatch();
        //HumidityVerificationJob::dispatch();
        TimeSetPointVerification::dispatch();
        SendAdminMails::dispatch();
    }
}
