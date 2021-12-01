<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewEventPatient extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     * testing
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
        ->subject(str_replace('_', " ", config('app.name', 'Laravel')) . ' | ' . \Lang::get($this->dataMsg['patient_subj']))
        ->view('staff.mail.staff.event.NewEventPatient')
        ->with(
            [
                'doctor_name' => $this->dataMsg['doctor_name'],
                'patient_subj' => \Lang::get($this->dataMsg['patient_subj']),
                'patient_date' => $this->dataMsg['patient_date'],
                'patient_body' => \Lang::get($this->dataMsg['patient_body'], ['doctor_name' => $this->dataMsg['doctor_name']]),
                'patient_name' => $this->dataMsg['patient_name'],
                'hour_to' => $this->dataMsg['hour_to'],
                'hour_from' => $this->dataMsg['hour_from'],
                'note' => $this->dataMsg['note']
                
            ]
        );
    }
}
