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
    protected $info = [];
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $info)
    {
        $this->info = $info;
        // change MSE host ip 設定檔案參考 config/mail.php
        // Config::set('mail.mailers.smtp.host', $this->info['ip']);
        $this->from($info['from']);
        $this->to($info['to']);
        $this->subject($info['subject']);
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
        return $this->view('mail.basic-text-sample-mail', ['contents' => $this->info['contents']]);
    }
}
