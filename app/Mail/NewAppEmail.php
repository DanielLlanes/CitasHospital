<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewAppEmail extends Mailable implements ShouldQueue
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
        $this->subject(str_replace('_', " ", config('app.name', 'Laravel')))
        ->view('staff.mail.staff.apps.NewAppEmail')
        ->with(
            [
                'service' => $this->data->treatment->service->service,
                'procedure' => $this->data->treatment->procedure->procedure,
                'package' => $this->data->treatment->package->package,
                'patient_name' => $this->data->patient->name,
                'patient_phone' => $this->data->patient->phone,
                'patient_email' => $this->data->patient->email,
                'staff_email' => $this->data->staff_email,
                'staff_name' => $this->data->staff_name,
                'url' => $this->data->app_id,
            ]
        );
    }
}
