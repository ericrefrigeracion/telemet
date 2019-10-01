<?php

namespace App\Console\Commands;

use App\Jobs\Rule\ProtectedDeviceRevissionJob;
use App\Jobs\Reception\EliminateReceptionsJob;
use App\Jobs\Pay\PaymentRevissionJob;
use App\Jobs\Pay\PaysVerification;
use App\Jobs\Mail\SendAdminMails;
use App\Jobs\Mail\SendUserMails;
use App\Jobs\Disconnect\DisconnectVerification;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'comando para prueba de jobs';

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
        DisconnectVerification::dispatch();
        //ProtectedDeviceRevissionJob::dispatch();
        //SendUserMails::dispatch();
        //SendAdminMails::dispatch();
        //EliminateReceptionsJob::dispatch();
        //PaysVerification::dispatch();
        //PaymentRevissionJob::dispatch(5145146876, 4, 1234, 1);
    }
}
