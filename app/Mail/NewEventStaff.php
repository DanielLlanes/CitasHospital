<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewEventStaff extends Mailable
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
        // doctor_email
        // doctor_name
        // doctor_lang
        // doctor_subjet
        // doctor_body
        // patient_name
        // patient_name
        // patient_mail
        // patient_lang
        // patient_subjet
        // patient_body
        // doctor_name

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        app()->setLocale($this->dataMsg['doctor_lang']);
        return $this->to($this->dataMsg['doctor_email'], $this->dataMsg['doctor_name'])
        ->subject(str_replace('_', " ", config('app.name', 'Laravel')) . ' | ' . $this->dataMsg['doctor_subjet'])
        ->view('staff.mail.staff.event.NewEventStaff')
        ->with(
            [
                'doctor_email' => $this->dataMsg['doctor_email'],
                'doctor_name' => $this->dataMsg['doctor_name'],
                'doctor_body' => $this->dataMsg['doctor_body'],
                'patient_name' => $this->dataMsg['patient_name'],
                'patient_name' => $this->dataMsg['patient_name'],
                'patient_mail' => $this->dataMsg['patient_mail'],
                'note' => $this->dataMsg['note'],
            ]
        );
    }
}
