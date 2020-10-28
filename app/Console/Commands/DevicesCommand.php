<?php

namespace App\Console\Commands;

use App\Jobs\DevicesProtectionsJob;
use App\Jobs\DevicesTopicControlsJob;
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
        DevicesProtectionsJob::dispatch();
        sleep(10);
        DevicesTopicControlsJob::dispatch();
        sleep(10);
        SendAdminMails::dispatch();
    }
}
