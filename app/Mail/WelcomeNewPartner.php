<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeNewPartner extends Mailable implements ShouldQueue
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
        return $this->to($this->dataMsg['reciver'], $this->dataMsg['reciverName'])
            ->subject(str_replace('_', " ", config('app.name', 'Laravel')))
            ->view('partners.mail.welcomenewpartners')
            ->with(
                [
                    'reciverName' => $this->dataMsg['reciverName'],
                    'reciverName' => $this->dataMsg['reciverName'],
                    'password' => $this->dataMsg['password'],
                    'email' => $this->dataMsg['reciver'],
                ]
            );
    }
}
