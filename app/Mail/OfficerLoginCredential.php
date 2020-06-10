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
	 public $mail_pass;
	
    public function __construct($userData)
    {       
        $this->emailid = $userData['email'];
        $this->ofname = $userData['name'];
        $this->username = $userData['username'];
        $this->mail_pass = $userData['mail_pass'];
         
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        //return $this->markdown('email.Register');
         return $this->from('noreply@nic.in','HRD')
                    ->to($this->emailid)
                    ->subject('User Credentials of Officer')
                    ->markdown('email.LoginCredential');
    }
}
