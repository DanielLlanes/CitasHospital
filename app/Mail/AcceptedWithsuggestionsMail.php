<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AcceptedWithsuggestionsMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    protected $data;

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
        return $this->to($this->data->staff_email, $this->data->staff_name)
        ->subject(str_replace('_', " ", config('app.name', 'Laravel')))
        ->view('staff.mail.staff.apps.'. $this->data->lang .'.acceptedWithsuggestionsMail')
        ->with(
            [
                'staff_name' => $this->data->staff_name,
                'staff_email' => $this->data->staff_email,
                'doctor' => $this->data->doctor,
                'app_id' => $this->data->app_id,
                'sugerencias' => $this->data->sugerencias,
                'patient' => $this->data->patient,
                'app' => $this->data->app,
                'procedimiento' => $this->data->procedimeiento,
            ]
        );
    }
}
