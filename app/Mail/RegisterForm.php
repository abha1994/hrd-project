<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Http\Request;

class RegisterForm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
    */
    public $emailid ;
    public $name;

    public function __construct($candidatename,$email_id)
    {       
        $this->emailid = $email_id;
        $this->name = $candidatename;
        
         
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        //return $this->markdown('email.Register');
         return $this->from('hrd@gov.in','HRD')
                    ->to($this->emailid)
                    ->subject('Email Verificattion for Registration')
                    ->markdown('email.Register');
    }
}
