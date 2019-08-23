<?php

namespace App\Console\Commands;

use App\Jobs\PaysVerification;
use Illuminate\Console\Command;

class PaysCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pays:revission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Revision del estado de los pagos realizados';

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
        PaysVerification::dispatch();
    }
}
