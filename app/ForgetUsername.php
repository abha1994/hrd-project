<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Http\Request;

class ForgetUsername extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
    */
    //public $emailid ;
   
    public $username;
    public $emailid;
	
	
	
     
    public function __construct($username,$email_id)
    {       
        $this->emailid = $email_id;
        $this->username = $username;
       
         
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
                    ->subject('HRD Username')
                    ->markdown('email.ForgetUsername');
    }
}
