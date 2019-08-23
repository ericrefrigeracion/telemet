<?php

namespace App\Console\Commands;

use App\Jobs\MaxHumVerification;
use App\Jobs\MinHumVerification;
use App\Jobs\MaxTempVerification;
use App\Jobs\MinTempVerification;
use App\Jobs\PayVigentVerification;
use App\Jobs\DisconnectVerification;
use App\Jobs\SetPointTempChangeVerification;
use App\Jobs\SetPointHumChangeVerification;
use App\Jobs\TimeHumVerification;
use App\Jobs\TimeTempVerification;
use App\Jobs\TimeSetPointVerification;
use App\Jobs\SendAdminMails;
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
        MaxTempVerification::dispatch();
        MinTempVerification::dispatch();
        //MaxHumVerification::dispatch();
        //MinHumVerification::dispatch();
        SetPointTempChangeVerification::dispatch();
        //SetPointHumChangeVerification::dispatch();
        TimeTempVerification::dispatch();
        //TimeHumVerification::dispatch();
        TimeSetPointVerification::dispatch();
        SendAdminMails::dispatch();
    }
}
