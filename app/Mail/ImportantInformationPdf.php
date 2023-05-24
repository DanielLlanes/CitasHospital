<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ImportantInformationPdf extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->data[0]->patient->email, $this->data[0]->patient->name)
        ->replyTo($this->data[0]->staff->email, $this->data[0]->staff->name)
        ->subject(str_replace('_', " ", config('app.name', 'Laravel')) . ' | ' . $this->data[0]->subject)
        ->view('staff.mail.staff.apps.'.$this->data[0]->patient->lang.'.importantInfo')
        ->attach($this->data[0]->filePath)
        ->with(
            [
                'patient' => $this->data[0]->patient,
                'coordinator' => $this->data[0]->staff,
                'brand' => $this->data[0]->brand,

            ]
        );
    }
}
