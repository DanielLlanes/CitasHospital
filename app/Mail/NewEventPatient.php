<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewEventPatient extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $dataMsg;
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
        app()->setLocale($this->dataMsg['patient_lang']);
        return $this->to($this->dataMsg['patient_mail'], $this->dataMsg['patient_name'])
        ->subject(str_replace('_', " ", config('app.name', 'Laravel')) . ' | ' . $this->dataMsg['patient_subjet'])
        ->view('staff.mail.staff.event.NewEventPatient')
        ->with(
            [
                'patient_name' => $this->dataMsg['patient_name'],
                'patient_mail' => $this->dataMsg['patient_mail'],
                'patient_body' => $this->dataMsg['patient_body'],
                'note' => $this->dataMsg['note'],
                
            ]
        );
    }
}
