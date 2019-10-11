<?php

namespace App\Console\Commands;

use App\Jobs\SystemRevissionJob;
use Illuminate\Console\Command;

class SystemRevissionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:revission';
    protected $description = 'Revisiones generales diarias del sistema';

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
        SystemRevissionJob::dispatch();
    }
}
