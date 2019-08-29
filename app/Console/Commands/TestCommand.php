<?php

namespace App\Console\Commands;

use App\Jobs\PaymentRevissionJob;
use App\Jobs\MerchantOrderRevissionJob;
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
        PaymentRevissionJob::dispatch(5133078383);
        //MerchantOrderRevissionJob::dispatch(1137605471);
    }
}
