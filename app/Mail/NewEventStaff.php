<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewEventStaff extends Mailable implements ShouldQueue
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
        app()->setLocale($this->dataMsg['doctor_lang']);

        return $this->to($this->dataMsg['doctor_email'], $this->dataMsg['doctor_name'])
        ->subject(str_replace('_', " ", config('app.name', 'Laravel')) . ' | ' . \Lang::get($this->dataMsg['doctor_subj']))
        ->view('staff.mail.staff.event.NewEventStaff')
        ->with(
            [
                'doctor_name' => $this->dataMsg['doctor_name'],
                'doctor_subj' => \Lang::get($this->dataMsg['doctor_subj']),
                'doctor_date' => $this->dataMsg['doctor_date'],
                'doctor_body' => \Lang::get($this->dataMsg['doctor_body'], ['patient_name' => $this->dataMsg['patient_name']]),
                'patient_name' => $this->dataMsg['patient_name'],
                'hour_to' => $this->dataMsg['hour_to'],
                'hour_from' => $this->dataMsg['hour_from'],
                'note' => $this->dataMsg['note']
            ]
        );
    }
}
