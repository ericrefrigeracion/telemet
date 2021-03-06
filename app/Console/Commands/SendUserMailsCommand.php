<?php

namespace App\Console\Commands;

use App\Jobs\Mail\SendUserMails;
use Illuminate\Console\Command;

class SendUserMailsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mails:user';
    protected $description = 'Envia los mails a los usuarios.';

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
        SendUserMails::dispatch();
    }
}
