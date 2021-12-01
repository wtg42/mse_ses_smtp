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

    public $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     * @todo 實作 php artisan command 送信到特定 host ip
     * @return void
     */
    public function handle()
    {
        // Backup your default mailer
        // $backup = Mail::getSwiftMailer();

        // Setup your gmail mailer
        $gmail = new \Swift_SmtpTransport($this->data['ip'], 25, null);

        // Set the mailer as gmail
        Mail::setSwiftMailer(new \Swift_Mailer($gmail));

        // Send your message
        Mail::send(new BasicTextSampleMail($this->data));

        // Restore your original mailer
        // Mail::setSwiftMailer($backup);
    }
}
