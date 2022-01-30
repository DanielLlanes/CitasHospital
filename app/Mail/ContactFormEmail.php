<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        
        return $this->to($this->data['email_reciver'], $this->data['name_reciver'])
        ->replyTo($this->data['email'], $this->data['name'])
        ->subject(str_replace('_', " ", config('app.name', 'Laravel')) . ' | Web contact')
        ->view('staff.mail.staff.contact.contactFormEmail')
        ->with(
            [
                "subject" => $this->data['subject'],
                "phone" => $this->data['phone'],
                "email" => $this->data['email'],
                "name" => $this->data['name'],
                "msg" => $this->data['msg'],
                "name_reciver" => $this->data['name_reciver']
                
            ]
        );
    }
}
