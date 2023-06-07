<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeLetterEmail extends Mailable 
{
    use Queueable, SerializesModels;

    public $patient;
    public $treatment;
    public $coordinator;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($patient, $treatment, $coordinator)
    {
        $this->patient = $patient;
        $this->treatment = $treatment;
        $this->coordinator = $coordinator;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->patient->email, $this->patient->name)
        ->replyTo($this->coordinator->email, $this->coordinator->name)
        ->subject(str_replace('_', " ", config('app.name', 'Laravel')) . ' | Welcome Letter')
        ->view('staff.mail.staff.apps.'.$this->patient->lang.'.welcomeLetter')
        ->with(
            [
                "patient" => 'patient',
                "coordinator" => 'coordinator',
                "treatment" => 'treatment',
            ]
        );
    }
}
