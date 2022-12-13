<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AcceptedWithChangeOfProcedureEmail extends Mailable 
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
        return $this->to($this->data->coor, $this->data->email)
        ->subject(str_replace('_', " ", config('app.name', 'Laravel')))
        ->view('staff.mail.staff.apps.'. $this->data->lang .'.changeOfProcedureEmail')
        ->with(
            [
                'patient' => $this->data->patient,
                'phone' => $this->data->phone,
                'mobile' => $this->data->mobile,
                'email' => $this->data->email,
                'coor' => $this->data->coor,
                'email' => $this->data->email,
                'lang' => $this->data->lang,
                'reccomended' => $this->data->reccomended,
                'old' => $this->data->old,
                'doc' => $this->data->doctor,
                'medicalRecommendations' => $this->data->medicalRecommendations,
                'medicalIndications' => $this->data->medicalIndications,
            ]
        );
    }
}
