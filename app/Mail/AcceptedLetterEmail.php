<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AcceptedLetterEmail extends Mailable implements ShouldQueue
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
        return $this->to($this->data->email, $this->data->patient)
        ->replyTo($this->data->coordinator->email, $this->data->coordinator->name)
        ->subject(str_replace('_', " ", config('app.name', 'Laravel')) . ' | accepted')
        ->view('staff.mail.staff.apps.'.$this->data->lang.'.acceptedLetter')
        ->with(
            [
                'patient' => $this->data->patient,
                'email' => $this->data->email,
                'lang' => $this->data->lang,
                'brand' => $this->data->brand,
                'service' => $this->data->service,
                'procedure' => $this->data->procedure,
                'package' => $this->data->package,
                'includes' => $this->data->includes,
                'price' => $this->data->price,
                'downPayment' => $this->data->downPayment,
                'indications' => $this->data->indications,
                'recomendations' => $this->data->recomendations,
                'coordinator' => $this->data->coordinator,
                'sugerencias' => $this->data->sugerencias,

            ]
        );
    }
}
