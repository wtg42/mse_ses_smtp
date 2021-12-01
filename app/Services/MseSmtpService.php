<?php

namespace App\Services;

use App\Mail\BasicTextSampleMail;
use Illuminate\Support\Facades\Mail;

class MseSmtpService
{
    protected $host = '';
    protected $from = '';
    protected $to = '';

    public static function sendMail($smtpInfo)
    {
        // Backup your default mailer
        $backup = Mail::getSwiftMailer();

        // Setup your gmail mailer
        $gmail = new \Swift_SmtpTransport($smtpInfo['ip'], 25, null);

        // Set the mailer as gmail
        Mail::setSwiftMailer(new \Swift_Mailer($gmail));

        // Send your message
        Mail::send(new BasicTextSampleMail($smtpInfo));

        // Restore your original mailer
        Mail::setSwiftMailer($backup);
    }

    /**
     * Set smtp host ip
     * @param string $host
     * @return $this
     */
    public function setHost(String $host)
    {
        $this->host = $host;
        return $this;
    }

    /**
     * Set from address
     * @param string $from
     * @return $this
     */
    public function setFrom(String $from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * Set to address
     * @param string $to
     * @return $this
     */
    public function setTo(String $to)
    {
        $this->to = $to;
        return $this;
    }
}
