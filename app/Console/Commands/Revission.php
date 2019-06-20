<?php

namespace App\Console\Commands;

use App\Jobs\SendMails;
use App\Jobs\DeviceConnection;
use App\Jobs\VerifyHumidity;
use App\Jobs\VerifyTemperature;
use Illuminate\Console\Command;

class Revission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'revission:devices';

    /**
     * The console command description.
     *
     * @var string
     */
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
        //DeviceConnection::dispatch();
        //VerifyTemperature::dispatch();
        VerifyHumidity::dispatch();
        //SendMails::dispatch();
    }
}
