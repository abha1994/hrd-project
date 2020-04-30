<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Http\Request;

class OfficerLoginCredential extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
    */
    public $emailid ;
    public $ofname;
    public $username;

    public function __construct($userData)
    {       
        $this->emailid = $userData['email'];
        $this->ofname = $userData['name'];
        $this->username = $userData['username'];
        
         
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
                    ->subject('User Credentials of Officer')
                    ->markdown('email.LoginCredential');
    }
}
