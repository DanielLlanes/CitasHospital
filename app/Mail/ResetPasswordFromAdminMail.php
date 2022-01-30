<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordFromAdminMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $dataMsg;

    public function __construct($dataMsg)
    {
        $this->dataMsg = $dataMsg;
    }


    public function build()
    {
        app()->setLocale($this->dataMsg['lang']);

        return $this->to($this->dataMsg['reciver'], $this->dataMsg['reciverName'])
        ->subject(str_replace('_', " ", config('app.name', 'Laravel')))
        ->view('staff.mail.staff.staff.ResetPasswordFromAdminMail')
        ->with(
            [
                'reciverName' => $this->dataMsg['reciverName'],
                'reciverName' => $this->dataMsg['reciverName'],
                'password' => $this->dataMsg['password'],
                'username' => $this->dataMsg['username'],
                'email' => $this->dataMsg['reciver'],
            ]
        );
    }
}
