<?php

namespace App\Services;

use App\Mail\BasicTextSampleMail;
use Illuminate\Support\Facades\Mail;

class MseSmtpService
{
    // mailer info
    protected $host = '';
    protected $from = '';
    protected $to = '';
    protected $subject = '';
    protected $contents = '';
    protected $port = 25;

    // singleton
    private static $instance = null;

    // singleton pattern
    private function __construct()
    {
    }
    /**
     * singleton function
     * @return MseSmtpService
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * 設定並執行打信
     * 此功能因應 Laravel 載入了 singleton mailer 所以需要另外創建一個實例
     * @return void
     */
    public function sendMail()
    {
        // Backup your default mailer
        $backup = Mail::getSwiftMailer();

        // Setup your mseTransport mailer
        $mseTransport = new \Swift_SmtpTransport($this->host, $this->port, null);

        // Set the mailer as mseTransport
        Mail::setSwiftMailer(new \Swift_Mailer($mseTransport));

        // Send your message, 目前只吃這四個欄位
        Mail::send(new BasicTextSampleMail([
            'from' => $this->from,
            'to' => $this->to,
            'subject' => $this->subject,
            'contents' => $this->contents,
        ]));

        // Restore your original mailer
        Mail::setSwiftMailer($backup);
    }

    /**
     * Set smtp host ip
     * @param string $host
     * @return $this
     */
    public function setHost(string $host)
    {
        $this->host = $host;
        return $this;
    }

    /**
     * Set from address
     * @param string $from
     * @return $this
     */
    public function setFrom(string $from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * Set to address
     * @param string $to
     * @return $this
     */
    public function setTo(string $to)
    {
        $this->to = $to;
        return $this;
    }

    public function setSubject(string $subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * Set mail contents
     * @param string $contents
     * @return $this
     */
    public function setContents(string $contents)
    {
        $this->contents = $contents;
        return $this;
    }
}
