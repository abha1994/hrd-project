<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Http\Request;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
    */
    //public $emailid ;
   
    public $user_password;
    public $emailid;
	
	
	
     
    public function __construct($user_password,$email_id)
    {       
        $this->emailid = $email_id;
        $this->user_password = $user_password;
       
         
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        
         return $this->from('hrd@gov.in','HRD')
                    ->to($this->emailid)
                    ->subject('HRD New Password')
                    ->markdown('email.ResetPassword');
    }
}
