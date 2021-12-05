<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class BasicTextSampleMail extends Mailable
{
    use Queueable, SerializesModels;

    // 表單送過來的資料
    protected $mailerInfo = [];
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $mailerInfo)
    {
        $this->mailerInfo = $mailerInfo;
        // change MSE host ip 設定檔案參考 config/mail.php
        // Config::set('mail.mailers.smtp.host', $this->info['ip']);
        $this->from($this->mailerInfo['from']);
        $this->to($this->mailerInfo['to']);
        $this->subject($this->mailerInfo['subject']);
        // ray($this->info['ip']);
        // ray(Config::get('mail'));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.basic-text-sample-mail', ['contents' => $this->mailerInfo['contents']]);
    }
}
