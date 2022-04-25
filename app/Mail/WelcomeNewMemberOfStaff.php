<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeNewMemberOfStaff extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $dataMsg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataMsg)
    {
        $this->dataMsg = $dataMsg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        //$lang = auth()->guard('staff')->user()->lang;
        app()->setLocale($this->dataMsg['lang']);

        return $this->to($this->dataMsg['reciver'], $this->dataMsg['reciverName'])
        ->subject(str_replace('_', " ", config('app.name', 'Laravel')))
        ->view('staff.mail.staff.staff.welcomenewmemberofstaff')
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
