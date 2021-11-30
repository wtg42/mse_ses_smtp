<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\BasicTextSampleMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class MseSendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     * @todo 實作 php artisan command 送信到特定 host ip
     * @return void
     */
    public function handle()
    {
        // Mail::send(new BasicTextSampleMail());
    }
}
