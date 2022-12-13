<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AcceptedUnassignedEmail extends Mailable
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
         return $this->to($this->data->email, $this->data->coor)
        ->subject(str_replace('_', " ", config('app.name', 'Laravel')))
        ->view('staff.mail.staff.apps.'. $this->data->lang .'.AcceptedUnassignedEmail')
        ->with(
            [
                'doctor' => $this->data->doctor,
                'app' => $this->data->app,
            ]
        );
    }
}
