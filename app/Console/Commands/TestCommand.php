<?php

namespace App\Console\Commands;

use App\Jobs\Rule\ProtectedDeviceRevissionJob;
use App\Jobs\Pay\PaymentRevissionJob;
use App\Jobs\Pay\PaysVerification;
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
        //ProtectedDeviceRevissionJob::dispatch();
        PaysVerification::dispatch();
        //PaymentRevissionJob::dispatch(5153779296, 4, 1234, 1);
    }
}
