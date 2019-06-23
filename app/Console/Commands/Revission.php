<?php

namespace App\Console\Commands;

use App\Jobs\SendMails;
use App\Jobs\VerifyConnection;
use App\Jobs\VerifyHumidity;
use App\Jobs\VerifyTemperature;
use Illuminate\Console\Command;

class Revission extends Command
{

    protected $signature = 'revission:devices';
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
        VerifyConnection::dispatch();
        VerifyTemperature::dispatch();
        VerifyHumidity::dispatch();
        //SendMails::dispatch();
    }
}
