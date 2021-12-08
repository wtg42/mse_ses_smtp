<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Services\MseSmtpService;
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

    public array $mailerInfo = [
        'ip' => '',
        'from' => '',
        'to' => '',
        'contents' =>'',
        'subject' => '',
    ];
    /**
     * Create a new job instance.
     * @param array $mailRequest
     * @return void
     */
    public function __construct(array $mailRequest)
    {
        // $mailRequest 送來的 mailer 資訊填入對應 $this->mailerInfo 資訊
        tap(array_filter($mailRequest, function ($key) {
            return array_key_exists($key, $this->mailerInfo);
        }, ARRAY_FILTER_USE_KEY), function ($filter_arr) {
            return $this->mailerInfo = $filter_arr;
        });
    }

    /**
     * Execute the job.
     * @todo 實作 php artisan command 送信到特定 host ip
     * @return void
     */
    public function handle()
    {
        MseSmtpService::getInstance()
            ->setHost($this->mailerInfo['ip'])
            ->setFrom($this->mailerInfo['from'])
            ->setTo($this->mailerInfo['to'])
            ->setSubject($this->mailerInfo['subject'])
            ->setContents($this->mailerInfo['contents'])
            ->sendMail();

        // Backup your default mailer
        // $backup = Mail::getSwiftMailer();

        // Setup your gmail mailer
        $gmail = new \Swift_SmtpTransport($this->mailerInfo['ip'], 25, null);

        // Set the mailer as gmail
        Mail::setSwiftMailer(new \Swift_Mailer($gmail));

        // Send your message
        Mail::send(new BasicTextSampleMail($this->mailerInfo));

        // Restore your original mailer
        // Mail::setSwiftMailer($backup);
    }
}
