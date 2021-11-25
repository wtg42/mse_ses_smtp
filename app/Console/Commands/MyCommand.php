<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\BasicTextSampleMail;
use Illuminate\Support\Facades\Mail;

class MyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'do:sendmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test any code what you want to.';

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
     * @return int
     */
    public function handle()
    {
        Mail::queue(new BasicTextSampleMail());
        return Command::SUCCESS;
    }
}
