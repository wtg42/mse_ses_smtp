<?php

namespace App\Services;

use App\Mail\BasicTextSampleMail;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class MseSmtpService
{
    public static function sendMail($validatedData)
    {
        // change MSE host ip 設定檔案參考 config/mail.php
        config(['mail.mailers.smtp.host' => $validatedData['ip']]);
        // re-create singleton
        App::forgetInstance('mail.manager');
        Mail::send(new BasicTextSampleMail($validatedData));
    }
}
